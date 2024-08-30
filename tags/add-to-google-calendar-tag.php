<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_Dynamic_Tag_Add_To_Google_Calendar extends \Elementor\Core\DynamicTags\Tag {

  // Метод повертає назву тегу
	public function get_name() {
		return 'add-to-google-calendar';
	}

  // повертає назву, що відображається в меню вибору
	public function get_title() {
		return esc_html__( 'Add to Google Calendar', 'elementor-google-calendar-dynamic-tag' );
	}

  // визначає до якої категорії в меню динамічних тегів належить тег
	public function get_group() {
		return [ 'site' ];
	}

  // категорія тегу - УРЛ
	public function get_categories() {
		return [ \Elementor\Modules\DynamicTags\Module::URL_CATEGORY ];
	}

  // реєструєм контроли
	protected function register_controls() {
		$this->add_control(
				'text',
				[
						'label' => __( 'Event Title', 'plugin-name' ),
						'type' => \Elementor\Controls_Manager::TEXT,
				]
		);

		$this->add_control(
				'date_start',
				[
						'label' => __( 'Start Date', 'plugin-name' ),
						'type' => \Elementor\Controls_Manager::TEXT,
				]
		);

		$this->add_control(
				'time_start',
				[
						'label' => __( 'Start Time', 'plugin-name' ),
						'type' => \Elementor\Controls_Manager::TEXT,
				]
		);

		$this->add_control(
				'date_end',
				[
						'label' => __( 'End Date', 'plugin-name' ),
						'type' => \Elementor\Controls_Manager::TEXT,
				]
		);

		$this->add_control(
				'time_end',
				[
						'label' => __( 'End Time', 'plugin-name' ),
						'type' => \Elementor\Controls_Manager::TEXT,
				]
		);

		$this->add_control(
				'location',
				[
						'label' => __( 'Location', 'plugin-name' ),
						'type' => \Elementor\Controls_Manager::TEXT,
				]
		);

		$this->add_control(
				'details',
				[
						'label' => __( 'Details', 'plugin-name' ),
						'type' => \Elementor\Controls_Manager::TEXT,
				]
		);

		$this->add_control(
				'add',
				[
						'label' => __( 'Invitees', 'plugin-name' ),
						'type' => \Elementor\Controls_Manager::TEXT,
				]
		);

		$this->add_control(
				'ctz',
				[
						'label' => __( 'Timezone', 'plugin-name' ),
						'type' => \Elementor\Controls_Manager::TEXT,
				]
		);
}


	// витягуєм дату з контролів/полів і генеруєм УРЛ для Google Calendar
	public function render() {
		$text = $this->get_settings( 'text' );
		$date_start = $this->get_settings( 'date_start' );
		$time_start = $this->get_settings( 'time_start' );
		$date_end = $this->get_settings( 'date_end' );
		$time_end = $this->get_settings( 'time_end' );
		$location = $this->get_settings( 'location' );
		$details = $this->get_settings( 'details' );
		$add = $this->get_settings( 'add' );
		$ctz = $this->get_settings( 'ctz' );

		// валідуєм дати
		$dates = $this->format_dates( $date_start, $time_start, $date_end, $time_end );

		$url = 'https://calendar.google.com/calendar/render?action=TEMPLATE';
		$url .= '&text=' . urlencode( $text );
		$url .= '&dates=' . urlencode( $dates );
		$url .= '&location=' . urlencode( $location );
		$url .= '&details=' . urlencode( $details );
		$url .= '&add=' . urlencode( $add );
		$url .= '&ctz=' . urlencode( $ctz );

		echo $url;
	}


  // внутрішній метод для валідації дат
	protected function format_dates( $date_start, $time_start, $date_end, $time_end ) {
		$start = date( 'Ymd\THis', strtotime( $date_start . ' ' . $time_start ) );
		if ( empty( $date_end ) ) {
				$date_end = $date_start;
		}
		if ( empty( $time_end ) ) {
				$time_end = date( 'H:i', strtotime( $time_start . ' +1 hour' ) );
		}
		$end = date( 'Ymd\THis', strtotime( $date_end . ' ' . $time_end ) );

		return $start . '/' . $end;
}

}