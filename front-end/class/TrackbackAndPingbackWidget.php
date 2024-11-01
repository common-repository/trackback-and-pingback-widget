<?php
class TrackbackAndPingbackWidget extends WP_Widget {
	
	public function __construct() {
		
		parent::__construct(
	 		'tackback_and_pingback_widget', 
			'Trackback and Pingback Widget', 
			array( 'description' => __( 'A widget to display trackbacks and pingbacks of the current page.', 'trackback-and-pingback-widget' ), ) // Args
		);
		
	}
	
	static public function registerWidget() {
		return register_widget( 'TrackbackAndPingbackWidget' );	// the class name - get_class( self ) does not work.
	}

    function form( $aInstance ) {
		
        $title = esc_attr( isset( $aInstance['title'] ) ? $aInstance['title'] : '' );
        $numitems = empty( $aInstance['numitems'] ) ? 0 : esc_attr( $aInstance['numitems'] );		// the number of items to show
        $order = empty( $aInstance['order'] ) ? 1 : esc_attr( $aInstance['order'] );		// whether the newsest comes first or the olderst comes first
		$arrOrders = array( array( 'label' => __( 'Newest First', 'trackback-and-pingback-widget' ), 'value' => 1 ),
						    array( 'label' => __( 'Oldest First', 'trackback-and-pingback-widget' ), 'value' => 2 ),
						);
		$renderdate = empty( $aInstance['renderdate'] ) ? 0 : esc_attr( $aInstance['renderdate'] );		// whether the date is rendered
		$style = empty( $aInstance['style'] ) ? 'ol' : esc_attr( $aInstance['style'] );		// sets the default to 1 if it is empty
		$arrStyles = array( array( 'label' => 'ol', 'value' => 'ol' ),
						    array( 'label' => 'ul', 'value' => 'ul' ),
						    array( 'label' => 'div', 'value' => 'div' )
						);
		$type = empty( $aInstance['type'] ) ? 'pings' : esc_attr( $aInstance['type'] );		// sets the default to 1 if it is empty
		$arrTypes = array( array( 'label' => __( 'Trackbacks and Pingbacks', 'trackback-and-pingback-widget' ), 'value' => 'pings' ),	// 'all', 'comment', 'trackback', 'pingback', or 'pings'.
						    array( 'label' => __( 'Comments', 'trackback-and-pingback-widget' ), 'value' => 'comment' ),
						    array( 'label' => __( 'Trackbacks', 'trackback-and-pingback-widget' ), 'value' => 'trackback' ),
						    array( 'label' => __( 'Pingbacks', 'trackback-and-pingback-widget' ), 'value' => 'pingback' ),
						    array( 'label' => __( 'All', 'trackback-and-pingback-widget' ), 'value' => 'all' )
						);		
						
		$show_not_found_message = ! isset( $aInstance['show_not_found_message'] ) ? 1 : esc_attr( $aInstance['show_not_found_message'] );		// whether the not found message should be shown in the widget output.
		
        ?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'trackback-and-pingback-widget' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
		
		<p><label for="<?php echo $this->get_field_id('numitems'); ?>"><?php _e( 'Number of tack/pingbacks to show ( set 0 to show all) :', 'trackback-and-pingback-widget' ); ?> <input class="" id="<?php echo $this->get_field_id('numitems'); ?>" name="<?php echo $this->get_field_name('numitems'); ?>" type="text" size="3" value="<?php echo $numitems; ?>" /></label></p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'order' ); ?>"><?php _e( 'Select Order:', 'trackback-and-pingback-widget' ); ?></label><br />
			<select name="<?php echo $this->get_field_name( 'order' ); ?>" id="<?php echo $this->get_field_id( 'order' ); ?>">
				<?php 
				foreach($arrOrders as $arrOrder) 
					echo '<option value="' . esc_attr( $arrOrder['value'] ) . '" ' . ( $arrOrder['value'] == $order ? 'selected="Selected"' : '' ) . '>'
						. $arrOrder['label'] 
						. '</option>';
				?>
			</select>
		</p>
		
		<p>
			<input name="<?php echo $this->get_field_name('show_not_found_message'); ?>" type="hidden" value="0" />
			<input id="<?php echo $this->get_field_id('show_not_found_message'); ?>" name="<?php echo $this->get_field_name('show_not_found_message'); ?>" type="checkbox" value="1" <?php if ( $show_not_found_message ) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id('show_not_found_message'); ?>"><?php _e( 'Display the Not Found message?', 'trackback-and-pingback-widget' ); ?></label>
		</p>		
		
		<p>
			<input id="<?php echo $this->get_field_id('renderdate'); ?>" name="<?php echo $this->get_field_name('renderdate'); ?>" type="checkbox" value="1" <?php if ( $renderdate ) echo 'checked="checked"'; ?>/>
			<label for="<?php echo $this->get_field_id('renderdate'); ?>"><?php _e( 'Display item date?', 'trackback-and-pingback-widget' ); ?></label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'style' ); ?>"><?php _e( 'Enclosing HTML Tag:', 'trackback-and-pingback-widget' ); ?></label><br />
			<select name="<?php echo $this->get_field_name( 'style' ); ?>" id="<?php echo $this->get_field_id( 'style' ); ?>">
				<?php 
				foreach( $arrStyles as $arrStyle ) 
					echo '<option value="' . esc_attr( $arrStyle['value'] ) . '" ' . ( $arrStyle['value'] == $style ? 'selected="Selected"' : '' ) . '>'
						. $arrStyle['label'] 
						. '</option>';
				?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'type' ); ?>"><?php _e( 'Type:', 'trackback-and-pingback-widget' ); ?></label><br />
			<select name="<?php echo $this->get_field_name( 'type' ); ?>" id="<?php echo $this->get_field_id( 'type' ); ?>">
				<?php 
				foreach( $arrTypes as $arrType ) 
					echo '<option value="' . esc_attr( $arrType['value'] ) . '" ' . ( $arrType['value'] == $type ? 'selected="Selected"' : '' ) . '>'
						. $arrType['label'] 
						. '</option>';
				?>
			</select>
		</p>	
        <?php
    }

    function update( $new_instance, $old_instance ) {
        $new_instance['title'] = strip_tags( $new_instance['title'] );
        $new_instance['numitems'] = strip_tags( $new_instance['numitems'] );
        $new_instance['order'] = strip_tags( $new_instance['order'] );
        $new_instance['renderdate'] = strip_tags( $new_instance['renderdate'] );
        $new_instance['style'] = strip_tags( $new_instance['style'] );
        $new_instance['type'] = strip_tags( $new_instance['type'] );
        return $new_instance;
    }
	
	/**
	 * The method which actually outputs the widget contents
	 */
    function widget( $aArgs, $aInstance ) {
		
		/*
		 * If the current post is protected by a password and
		 * the visitor has not yet entered the password we will
		 * return early without loading the comments.
		 */
		if ( post_password_required() ) return;	
		
		// Check the number of trackback/pingback comments
		$iCount = $this->getCountTrackAndPingbacks( get_the_ID() );
		if ( $iCount == 0 && ! $aInstance['show_not_found_message'] ) 
			return;

		echo $this->getCommentOutput( $aArgs, $aInstance, $iCount );
		
    }
	
	/**
	 * Count the number of pingbacks and trackbacks for a post.
	 *
	 * @return			int
	 */
	protected function getCountTrackAndPingbacks( $iPostID=null ) {
		
		$iCount = 0;
		$aComments = array();

		if ( $iPostID ) {
			$aComments = get_comments(
				array (
					'post_id' => $iPostID,
					'status'  => 'approve'
				)
			);			
		} else if ( ! empty ( $GLOBALS['wp_query']->comments ) ) 
			$aComments = $GLOBALS['wp_query']->comments;
		

		foreach ( $aComments as $oComment )
			if ( in_array ( $oComment->comment_type, array ( 'pingback', 'trackback' ) ) )
				$iCount += 1;

		return $iCount;
		
	}	
	
	protected function getCommentOutput( $aArgs, $aInstance, $iCount ) {
		
		// Options	- $aArgs values are currently not used.
		$aInstance['title'] = apply_filters( 'widget_title', $aInstance['title'] );
		$aInstance['style'] = apply_filters( 'widget_title', $aInstance['style'] );	// added since 1.0.1
		$aInstance['style'] = empty ( $aInstance['style'] ) ? 'div' : $aInstance['style'];
		$sTag = $aInstance['style'];
				
		// Start storing the output
		$sTitle = "<h3 class='widget-title'>{$aInstance['title']}</h3>";
		$sOpeningTag = "<{$sTag} class='commentlist'>";
		$sClosingTag = "</{$sTag}><!-- .commentlist -->";
		
		if ( $iCount == 0 )
			return $sTitle
				. $sOpeningTag
					. "<p>" . __( 'No Trackback or Pingback is Found.', 'trackback-and-pingback-widget' ) . "</p>"
				. $sClosingTag;
				
		$sOutput = $this->getCommentBuffer( $aInstance ); 
			
		return $sTitle
			. $sOpeningTag
				. balanceTags( $sOutput )
			. $sClosingTag;	
		
	}
	
	protected function getCommentBuffer( $aInstance ) {
				
		$numitems = apply_filters( 'widget_title', $aInstance['numitems'] );
		$order = apply_filters( 'widget_title', $aInstance['order'] );
		$renderdate = apply_filters( 'widget_title', $aInstance['renderdate'] );
		$type = apply_filters( 'widget_title', $aInstance['type'] );		// added since 1.0.1		
		
		// Called from the shortcode callback.
		// Capture the output buffer
		ob_start(); // start buffer
				
		$this->wp_list_comments(	
			array( 
				'callback' => array( $this, 'renderComments' ), 
				'type' => $type, 
				'style' => $aInstance['style'], 
				'renderdate' => $renderdate,
			),
			null,
			array( 'order' => $order, 'numitems' => $numitems )
		 );	
	
		$sContent = ob_get_contents(); // assign the content buffer to a variable
		ob_end_clean(); // end buffer and remove the buffer		
		return $sContent;	
	
	}


	function renderComments( $comment, $args, $depth ) {
// print '<pre>' . print_r($args, true) . '</pre>';		
// print '<hr />';
		
		$strTag = ( $args['style'] == 'div' ) ? 'div' : 'li';
		
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
			// Display trackbacks differently than normal comments.
		?>
		<<?php echo $strTag . ' '; comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			<?php 
			comment_author_link(); 
			if ( $args['renderdate'] )
				printf( 
					' - <a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
					esc_url( get_comment_link( $comment->comment_ID ) ),
					get_comment_time( 'c' ),
					/* translators: 1: date, 2: time */
					sprintf( __( '%1$s at %2$s', 'trackback-and-pingback-widget' ), get_comment_date(), get_comment_time() )
				);			
			edit_comment_link( ' ' . __( '(Edit)', 'trackback-and-pingback-widget' ), '<span class="edit-link">', '</span>' );
			?>			
		<?php
				break;
			default :
			// Proceed with normal comments.
			global $post;
		?>
		<<?php echo $strTag . ' '; comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<article id="comment-<?php comment_ID(); ?>" class="comment">
				<header class="comment-meta comment-author vcard">
					<?php
						echo get_avatar( $comment, 44 );
						printf( 
							'<cite class="fn">%1$s %2$s</cite>',
							get_comment_author_link(),
							// If current post author is also comment author, make it known visually.
							( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'trackback-and-pingback-widget' ) . '</span>' : ''
						);
						printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
							esc_url( get_comment_link( $comment->comment_ID ) ),
							get_comment_time( 'c' ),
							/* translators: 1: date, 2: time */
							sprintf( __( '%1$s at %2$s', 'trackback-and-pingback-widget' ), get_comment_date(), get_comment_time() )
						);
					?>
				</header><!-- .comment-meta -->

				<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'trackback-and-pingback-widget' ); ?></p>
				<?php endif; ?>

				<section class="comment-content comment">
					<?php comment_text(); ?>
					<?php edit_comment_link( __( 'Edit', 'trackback-and-pingback-widget' ), '<p class="edit-link">', '</p>' ); ?>
				</section><!-- .comment-content -->

				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'trackback-and-pingback-widget' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .reply -->
			</article><!-- #comment-## -->
		<?php
			break;
		endswitch; // end comment_type check		
	}
	
	function wp_list_comments( $args = array(), $comments = null, $arrArgs = array() ) {
		
		global $wp_query, $comment_alt, $comment_depth, $comment_thread_alt, $overridden_cpage, $in_comment_loop;

		$in_comment_loop = true;

		$comment_alt = $comment_thread_alt = 0;
		$comment_depth = 1;

		$defaults = array('walker' => null, 'max_depth' => '', 'style' => 'ul', 'callback' => null, 'end-callback' => null, 'type' => 'all',
			'page' => '', 'per_page' => '', 'avatar_size' => 32, 'reverse_top_level' => null, 'reverse_children' => '');
	
		// $defaults['reverse_top_level'] = $arrArgs['order'] == 1 ? false : true;	// 1: new ones come first, 2: old ones come first
		
		$r = wp_parse_args( $args, $defaults );

		// Figure out what comments we'll be looping through ($_comments)
		if ( null !== $comments ) {
			$comments = (array) $comments;
			if ( empty($comments) )
				return;
			if ( 'all' != $r['type'] ) {
				$comments_by_type = separate_comments($comments);
				if ( empty($comments_by_type[$r['type']]) )
					return;
				$_comments = $comments_by_type[$r['type']];
			} else {
				$_comments = $comments;
			}
		} else {
			if ( empty($wp_query->comments) )
				return;
			if ( 'all' != $r['type'] ) {
				if ( empty($wp_query->comments_by_type) )
					$wp_query->comments_by_type = separate_comments($wp_query->comments);
				if ( empty($wp_query->comments_by_type[$r['type']]) )
					return;
				$_comments = $wp_query->comments_by_type[$r['type']];
			} else {
				$_comments = $wp_query->comments;
			}
		}

		if ( '' === $r['per_page'] && get_option('page_comments') )
			$r['per_page'] = get_query_var('comments_per_page');

		if ( empty($r['per_page']) ) {
			$r['per_page'] = 0;
			$r['page'] = 0;
		}

		if ( '' === $r['max_depth'] ) {
			if ( get_option('thread_comments') )
				$r['max_depth'] = get_option('thread_comments_depth');
			else
				$r['max_depth'] = -1;
		}

		if ( '' === $r['page'] ) {
			if ( empty($overridden_cpage) ) {
				$r['page'] = get_query_var('cpage');
			} else {
				$threaded = ( -1 != $r['max_depth'] );
				$r['page'] = ( 'newest' == get_option('default_comments_page') ) ? get_comment_pages_count($_comments, $r['per_page'], $threaded) : 1;
				set_query_var( 'cpage', $r['page'] );
			}
		}
		// Validation check
		$r['page'] = intval($r['page']);
		if ( 0 == $r['page'] && 0 != $r['per_page'] )
			$r['page'] = 1;

		if ( null === $r['reverse_top_level'] )
			$r['reverse_top_level'] = ( 'desc' == get_option('comment_order') );

		extract( $r, EXTR_SKIP );

		if ( empty( $walker ) ) $walker = new Walker_TrackandPingbacks( $arrArgs );
			
		// render the elements
		$walker->paged_walk( $_comments, $max_depth, $page, $per_page, $r );

		$wp_query->max_num_comment_pages = $walker->max_pages;

		$in_comment_loop = false;
	}	
} // End class

class Walker_TrackandPingbacks extends Walker_comment {
	
	function __construct( $arrArgs ) {
		$this->arrArgs = $arrArgs;			
	}

	function SortByCommentDate( $a, $b ) {
		/*
		 * usort callback function
		 * */
	  if(  $a->comment_date ==  $b->comment_date ){ return 0 ; } 
	  return ($a->comment_date > $b->comment_date) ? -1 : 1;
	  
	} 
	
	function paged_walk( $elements, $max_depth, $page_num, $per_page ) {

		/* sanity check */
		if ( empty($elements) || $max_depth < -1 )
			return '';
			
		/*
		 * Sort the object by [comment_date]
		 * 
		[0] => stdClass Object
        (
            [comment_ID] => 20
            [comment_post_ID] => 467
            [comment_author] => Ejecuta rápidamente tus programas con tu ratón usando Quick Menu
            [comment_author_email] => 
            [comment_author_url] => http://techtastico.com/post/ejecuta-rapidamente-tus-programas-con-tu-raton-usando-quick-menu/
            [comment_author_IP] => 69.73.174.242
            [comment_date] => 2011-07-23 14:46:32
            [comment_date_gmt] => 2011-07-23 05:46:32
            [comment_content] => [...] os directos y te gusta tener todos tus programas en un clic entonces te recomiendo utilizar Quick Menu. [...]
            [comment_karma] => 0
            [comment_approved] => 1
            [comment_agent] => 
            [comment_type] => pingback
            [comment_parent] => 0
            [user_id] => 0
        )		
		* */ 

		// options
		$arrArgs = $this->arrArgs;
		
		// sort by date
		usort( $elements, array( $this, 'SortByCommentDate' ) );	

		// limit the number of items to show
		// if ( $arrArgs['numitems'] != 0 ) 
		if ( $arrArgs['numitems'] != 0 )
			$elements = array_slice( (array) $elements, ( $arrArgs['order'] == 1 ) ? 0 : ( -1 * $arrArgs['numitems'] ), $arrArgs['numitems'] );

		// decide whether new ones come first or old ones come first		
		if ( $arrArgs['order'] == 1 ) $elements = array_reverse( $elements );

		$args = array_slice( func_get_args(), 4 );
		$output = '';

		$id_field = $this->db_fields['id'];
		$parent_field = $this->db_fields['parent'];

		$count = -1;
		if ( -1 == $max_depth )
			$total_top = count( $elements );
		if ( $page_num < 1 || $per_page < 0  ) {
			// No paging
			$paging = false;
			$start = 0;
			if ( -1 == $max_depth )
				$end = $total_top;
			$this->max_pages = 1;
		} else {
			$paging = true;
			$start = ( (int)$page_num - 1 ) * (int)$per_page;
			$end   = $start + $per_page;
			if ( -1 == $max_depth )
				$this->max_pages = ceil($total_top / $per_page);
		}

		// flat display
		if ( -1 == $max_depth ) {
			if ( !empty($args[0]['reverse_top_level']) ) {
				$elements = array_reverse( $elements );
				$oldstart = $start;
				$start = $total_top - $end;
				$end = $total_top - $oldstart;
			}

			$empty_array = array();
			foreach ( $elements as $e ) {
				$count++;
				if ( $count < $start )
					continue;
				if ( $count >= $end )
					break;
				$this->display_element( $e, $empty_array, 1, 0, $args, $output );
			}
			return $output;
		}

		/*
		 * separate elements into two buckets: top level and children elements
		 * children_elements is two dimensional array, eg.
		 * children_elements[10][] contains all sub-elements whose parent is 10.
		 */
		$top_level_elements = array();
		$children_elements  = array();
		foreach ( $elements as $e) {
			if ( 0 == $e->$parent_field )
				$top_level_elements[] = $e;
			else
				$children_elements[ $e->$parent_field ][] = $e;
		}

		$total_top = count( $top_level_elements );
		if ( $paging )
			$this->max_pages = ceil($total_top / $per_page);
		else
			$end = $total_top;

		if ( !empty($args[0]['reverse_top_level']) ) {
			$top_level_elements = array_reverse( $top_level_elements );
			$oldstart = $start;
			$start = $total_top - $end;
			$end = $total_top - $oldstart;
		}
		if ( !empty($args[0]['reverse_children']) ) {
			foreach ( $children_elements as $parent => $children )
				$children_elements[$parent] = array_reverse( $children );
		}

		foreach ( $top_level_elements as $e ) {
			$count++;

			//for the last page, need to unset earlier children in order to keep track of orphans
			if ( $end >= $total_top && $count < $start )
					$this->unset_children( $e, $children_elements );

			if ( $count < $start )
				continue;

			if ( $count >= $end )
				break;

			$this->display_element( $e, $children_elements, $max_depth, 0, $args, $output );
		}

		if ( $end >= $total_top && count( $children_elements ) > 0 ) {
			$empty_array = array();
			foreach ( $children_elements as $orphans )
				foreach( $orphans as $op )
					$this->display_element( $op, $empty_array, 1, 0, $args, $output );
		}

		return $output;
	}
}