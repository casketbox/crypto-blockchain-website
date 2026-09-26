/**
 * tovus — ヒーローのパララックス演出。
 * .site-hero の中の3枚の画像レイヤー（back / mid / front）を、
 * スクロール量とポインター位置に応じて異なる速さで動かします。
 * 「視差効果を減らす」設定の環境では何もしません。
 */
( function () {
	'use strict';

	var hero = document.querySelector( '.site-hero' );
	if ( ! hero ) {
		return;
	}
	if ( window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches ) {
		return;
	}

	var back = hero.querySelector( '.site-hero-layer--back' );
	var mid = hero.querySelector( '.site-hero-layer--mid' );
	var front = hero.querySelector( '.site-hero-layer--front' );
	var rafId = 0;
	var pointerX = 0;
	var pointerY = 0;

	function apply() {
		rafId = 0;
		var rect = hero.getBoundingClientRect();
		var progress = Math.min( Math.max( -rect.top / ( rect.height || 1 ), 0 ), 1 );
		if ( back ) {
			back.style.transform = 'translateY(' + progress * 36 + 'px)';
		}
		if ( mid ) {
			mid.style.transform = 'translateY(' + progress * 84 + 'px) translateX(' + pointerX * 12 + 'px)';
		}
		if ( front ) {
			front.style.transform =
				'translateY(' + ( progress * -28 + pointerY * -10 ) + 'px) translateX(' + pointerX * -16 + 'px)';
		}
	}

	function queue() {
		if ( ! rafId ) {
			rafId = window.requestAnimationFrame( apply );
		}
	}

	window.addEventListener( 'scroll', queue, { passive: true } );
	window.addEventListener(
		'pointermove',
		function ( event ) {
			if ( event.pointerType && event.pointerType !== 'mouse' ) {
				return;
			}
			var rect = hero.getBoundingClientRect();
			pointerX = ( event.clientX - rect.left ) / rect.width - 0.5;
			pointerY = ( event.clientY - rect.top ) / rect.height - 0.5;
			queue();
		},
		{ passive: true }
	);
	apply();
} )();
