<?php

return [
    'userManagement' => [
        'title'          => 'User Settings',
        'title_singular' => 'User Settings',
    ],
    'permission' => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
        ],
    ],
    'lead' => [
        'title'          => 'Leads',
        'title_singular' => 'Lead',
        'fields'         => [
            'id'                        => 'ID',
            'id_helper'                 => ' ',
            'name'                      => 'Name',
            'name_helper'               => ' ',
            'email'                     => 'Email',
            'email_helper'              => ' ',
            'phone'                     => 'Phone',
            'phone_helper'              => ' ',
            'origin'                    => 'Origin',
            'origin_helper'             => ' ',
            'tags'                      => 'Tags',
            'tags_helper'               => ' ',
            'exclusions'                => 'Exclusions',
            'exclusions_helper'         => ' ',
            'used_campaigns'            => 'Campaigns Used',
            'used_campaigns_helper'     => ' ',
            'created_at'                => 'Created at',
            'created_at_helper'         => ' ',
            'updated_at'                => 'Updated at',
            'updated_at_helper'         => ' ',
            'deleted_at'                => 'Deleted at',
            'deleted_at_helper'         => ' ',
        ],
        'assign_tags'                   => 'Assign Tags',
        'assign_exclusions'             => 'Assign Exclusions',
    ],
    'campaign' => [
        'title'          => 'Campaigns',
        'title_singular' => 'Campaign',
        'fields'         => [
            'id'                        => 'ID',
            'id_helper'                 => ' ',
            'name'                      => 'Name',
            'name_helper'               => ' ',
            'tags'                      => 'Tags',
            'tags_helper'               => ' ',
            'counties'                  => 'Countries',
            'counties_helper'           => ' ',
            'exclusions'                => 'Exclusions',
            'exclusions_helper'         => ' ',
            'countries'                 => 'Countries',
            'countries_helper'          => ' ',
            'servers'                   => 'Sending Servers',
            'servers_helper'            => ' ',
            'template'                  => 'Template',
            'template_helper'           => ' ',
            'scheduled_at'              => 'Scheduled at',
            'scheduled_at_helper'       => ' ',
            'completed_at'              => 'Completed at',
            'completed_at_helper'       => ' ',
            'created_at'                => 'Created at',
            'created_at_helper'         => ' ',
            'updated_at'                => 'Updated at',
            'updated_at_helper'         => ' ',
            'deleted_at'                => 'Deleted at',
            'deleted_at_helper'         => ' ',
        ],
    ],
    'tag' => [
        'title'          => 'Tags',
        'title_singular' => 'Tag',
        'fields'         => [
        ],
    ],
    'exclusion' => [
        'title'          => 'Exclusions',
        'title_singular' => 'Exclusion',
        'fields'         => [
        ],
    ],
    'sendingServer' => [
        'title'          => 'Sending Servers',
        'title_singular' => 'Sending Server',
        'fields'         => [
            'id'                        => 'ID',
            'id_helper'                 => ' ',
            'name'                      => 'Name',
            'name_helper'               => ' ',
            'sender_number'             => 'Sender Number',
            'sender_number_helper'      => ' ',
            'sender_api'                => 'Sender API',
            'sender_api_helper'         => ' ',
            'created_at'                => 'Created at',
            'created_at_helper'         => ' ',
            'updated_at'                => 'Updated at',
            'updated_at_helper'         => ' ',
            'deleted_at'                => 'Deleted at',
            'deleted_at_helper'         => ' ',
        ],
    ],
];
