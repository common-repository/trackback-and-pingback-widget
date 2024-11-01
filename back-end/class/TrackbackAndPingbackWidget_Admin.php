<?php
class TrackbackAndPingbackWidget_Admin {
	
	function __construct( $sFilePath ) {
		
		$this->sFilePath = $sFilePath;
		add_filter( 'plugin_row_meta', array( $this, 'replyToaddLinksInPluginListingTable' ), 10, 2 );
		
	}
	
	public function replyToaddLinksInPluginListingTable( $arrLinks, $sFilePath ) {
		
		if ( $sFilePath != plugin_basename( $this->sFilePath ) ) return $arrLinks;
		
		// add links to the $arrLinks array.
		$arrLinks[] = '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=J4UJHETVAZX34">' . __( 'Donate', 'trackback-and-pingback-widget' ) . '</a>';
		$arrLinks[] = '<a href="http://en.michaeluno.jp/contact/custom-order/?lang=' . ( WPLANG ? WPLANG : 'en' ) . '">' . __( 'Order custom plugin', 'trackback-and-pingback-widget' ) . '</a>';
		return $arrLinks;
		
	} 
	
}