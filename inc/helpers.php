<?php
    function hex2rgba( $color, $alpha = 1 ) {
        $color = trim( $color, '#' );

        if ( strlen( $color ) === 3 ) {
            $r = hexdec( str_repeat( $color[0], 2 ) );
            $g = hexdec( str_repeat( $color[1], 2 ) );
            $b = hexdec( str_repeat( $color[2], 2 ) );
        } elseif ( strlen( $color ) === 6 ) {
            $r = hexdec( substr( $color, 0, 2 ) );
            $g = hexdec( substr( $color, 2, 2 ) );
            $b = hexdec( substr( $color, 4, 2 ) );
        } else {
            return 'rgba(0,0,0,' . $alpha . ')'; // fallback
        }

        return "rgba({$r}, {$g}, {$b}, {$alpha})";
    }