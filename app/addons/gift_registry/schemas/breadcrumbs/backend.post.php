<?php
/***************************************************************************
*                                                                          *
*   (c) 2004 Vladimir V. Kalynyak, Alexey V. Vinokurov, Ilya M. Shalnev    *
*                                                                          *
* This  is  commercial  software,  only  users  who have purchased a valid *
* license  and  accept  to the terms of the  License Agreement can install *
* and use this program.                                                    *
*                                                                          *
****************************************************************************
* PLEASE READ THE FULL TEXT  OF THE SOFTWARE  LICENSE   AGREEMENT  IN  THE *
* "copyright.txt" FILE PROVIDED WITH THIS DISTRIBUTION PACKAGE.            *
****************************************************************************/

$schema['events.field_editor'] = array (
    array(
        'title' => 'events',
        'link' => 'events.search'
    )
);
$schema['events.add'] = array (
    array (
        'title' => 'events',
        'link' => 'events.search'
    ),
);
$schema['events.update'] = array (
    array (
        'type' => 'search',
        'prev_dispatch' => 'events.search',
        'title' => 'search_results',
        'link' => 'events.search.last_view'
    ),
    array (
        'title' => 'events',
        'link' => 'events.search.reset_view'
    )
);

return $schema;
