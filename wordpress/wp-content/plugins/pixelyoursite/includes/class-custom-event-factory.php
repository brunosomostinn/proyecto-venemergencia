<?php

namespace PixelYourSite;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class CustomEventFactory {


	public static function create( $args ) {

		// create event post object
		$post_id = wp_insert_post( array(
			'post_title'     => empty( $args['title'] ) ? 'Untitled' : sanitize_text_field( $args['title'] ),
			'post_type'      => 'pys_event',
			'post_status'    => 'publish',
			'ping_status'    => 'closed',
			'comment_status' => 'closed',
		), true );

		if ( is_wp_error( $post_id ) ) {
			return false;
		}

		$event = new CustomEvent( $post_id );
		$event->update( $args );

		return $event;

	}

	/**
	 * @param string $state Event state. Can be 'any', 'active' or 'paused'
	 * @param null   $post_id
	 *
	 * @return array
	 */
	public static function get( $state = 'any', $post_id = null ) {

        $trigger_types = array(
            'page_visit',
            'home_page',
            'scroll_pos',
            'post_type',
        );

		$limit = isset( $post_id ) ? 1 : -1;

		$args = array(
			'post_type'   => 'pys_event',
			'numberposts' => $limit,
			'meta_query'  => array(
				'relation' => 'AND'
			)
		);

		if( isset( $post_id ) ) {
			$args['include'] = (int) $post_id;
		}

		if ( $state !== 'any' ) {

			$args['meta_query'][] = array(
				'key'   => '_pys_event_state',
				'value' => $state
			);

		}

		$results = array();

		foreach ( get_posts( $args ) as $post ) {
		    $customEvent = new CustomEvent( $post->ID );
            $triggers = $customEvent->getTriggers();
            if ( !empty( $triggers ) ) {
                foreach ( $triggers as $trigger ) {
                    $trigger_type = $trigger->getTriggerType();

                    if ( in_array($trigger_type, $trigger_types)) {
                        $results[ $post->ID ] = $customEvent;
                        break;
                    }
                }
            }
		}
		
		return $results;

	}

	/**
	 * @param $post_id
	 *
	 * @return CustomEvent
	 */
	public static function getById( $post_id ) {

		$results = self::get( 'any', $post_id );

		if ( isset( $results[ $post_id ] ) ) {
			return $results[ $post_id ];
		} else {
			return new CustomEvent();
		}

	}

	public static function remove( $post_id ) {
		wp_delete_post( $post_id, true );
	}
	
	public static function makeClone( $post_id ) {
		
		if ( $event = self::getById( $post_id ) ) {
			
			$args = array(
				'title' => $event->getTitle() . ' (duplicate)',
			);
			
			// create new event
			$new_event = self::create( $args );
			
			if ( ! $new_event ) {
				return;
			}
            $data = get_post_meta( $event->getPostId(), '_pys_event_data' );
            $triggers = $event->getTriggers();
            $conditions = $event->getConditions();
			// copy meta from original event
            foreach ( $data as $meta_value ) {
                update_post_meta( $new_event->getPostId(), '_pys_event_data', maybe_unserialize( $meta_value ) );
            }
            if($triggers){
                update_post_meta( $new_event->getPostId(), '_pys_event_triggers', addslashes( serialize( $triggers ) ) );
            }
            if($conditions){
                update_post_meta( $new_event->getPostId(), '_pys_event_conditions', addslashes( serialize( $conditions ) ) );
            }
			
			// disable cloned event
			$new_event->disable();
			
		}
		
	}
	
}