<?php
/**
 * Add or edit section items
 */
if( ! class_exists( 'TUEXT_Control_AddEditItems' ) ) {
	class TUEXT_Control_AddEditItems extends WP_Customize_Control {

		public $type      = 'add-edit-items';
		public $item_type = '';
		public $section_type;

		public function to_json() {
			parent::to_json();
			$this->json['item_type'] = $this->item_type;
			$this->json['section_type'] = $this->section_type;
		}

		protected function content_template() {
			?>
			<button type="button" class="button tu-add-items" id="bx-section-add-some-{{ data.section_type }}">
				<span class="dashicons tu-add"></span>{{ data.item_type }}
			</button>
			<?php
		}


	}
}
