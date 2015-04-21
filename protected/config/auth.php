<?php
return array(
    'guest' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Guest',
        'bizRule' => null,
        'data' => null
    ),
    'user' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'User',
        'children' => array(
            'guest', // унаследуемся от гостя
        ),
        'bizRule' => null,
        'data' => null
    ),
    'manager' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Manager',
        'children' => array(
            'user',          // позволим менеджеру всё, что позволено пользователю
        ),
        'bizRule' => null,
        'data' => null
    ),
    'admin' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Administrator',
        'children' => array(
            'manager',         // позволим админу всё, что позволено менеджеру
        ),
        'bizRule' => null,
        'data' => null
    ),
	'pronik' => array(
		'type' => CAuthItem::TYPE_ROLE,
		'description' => 'Pronik Administrator',
		'children' => array(
			'admin',         // позволим админу всё, что позволено админу
		),
		'bizRule' => null,
		'data' => null
	),	
	'partner' => array(
		'type' => CAuthItem::TYPE_ROLE,
		'description' => 'Partner',
		'children' => array(
				'user',          // позволим менеджеру всё, что позволено пользователю
		),
		'bizRule' => null,
		'data' => null
	)			
);
?>