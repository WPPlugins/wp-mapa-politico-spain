<?php

	add_shortcode( 'wpmps-map', 'wpmps_show_map' );
	function wpmps_show_map( $atts ){


		/*$html_mapa = '<div class="wpim-wrap-mapa wp-border-img-mapa" style="background-color:'.get_option('wpmps_background_color').'">'
					.'<img id="wp-img-mapa"  src="'.plugins_url( 'wp-mapa-politico-spain/images/mapa_base_azul_claro.png' ).'" >'
					.'</div>'
					;
		return $html_mapa;*/
		$pagina_inicio = file_get_contents(plugins_url( 'wp-mapa-politico-spain/images/mapa_base_00.svg'));

		$wpmps_mapas =  get_option( 'wpmps_plugin_mapas' );
		$mapa = $wpmps_mapas[0];

		foreach ($mapa['areas'] as $cod_area => $value){
			$pagina_inicio = str_replace('[href'.$cod_area.']', esc_url($value['href']), $pagina_inicio);
			$pagina_inicio = str_replace('[target'.$cod_area.']', $value['target'], $pagina_inicio);
			$pagina_inicio = str_replace('[title'.$cod_area.']', $value['title'], $pagina_inicio);

		}

		$wpmps_styles = '<style>
			.provincia {
			    fill : '.get_option('wpmps_background_provincia_color').';
			    fill-opacity:1;

			 }

		  .provincia path {
		    transition: .6s fill;
		    fill: '.get_option('wpmps_background_provincia_color').';

		    stroke:#ffffff;
		    stroke-width:0.47999001000000002;
		    stroke-linecap:square;
		    stroke-miterlimit:10;

		  }

		  .provincia path:hover {
		    fill: '.get_option('wpmps_hover_provincia_color').';

		  }

			.africa {
				fill:#f4e2ba;
				stroke:#999999;
				stroke-width:0.90709335;
				stroke-miterlimit:3.86369991;
			}
			</style>';


		$pagina_inicio = $wpmps_styles.
										'<div class="wpim-wrap-mapa wp-border-img-mapa" style="background-color:'.get_option('wpmps_background_color').'">'
											.$pagina_inicio
									. '</div>';
		return $pagina_inicio;

	}
