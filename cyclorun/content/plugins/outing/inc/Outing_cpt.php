<?php

class Outing_cpt
{
    public function __construct()
    {
        add_action('init', [$this, 'create_cpt']);
        add_action('init', [$this, 'create_taxo']);
    }

    public function create_cpt()
    {
        $labels = [
            'name'                  => 'sorties',
            'singular_name'         => 'Sortie',
            'menu_name'             => 'Sortie',
            'name_admin_bar'        => 'Sortie',
            'archives'              => 'Archives des sorties',
            'attributes'            => 'Attributs des sortie',
            'parent_item_colon'     => 'Element parent',
            'all_items'             => 'Toutes les sorties',
            'add_new_item'          => 'Ajouter une nouvelle sortie',
            'add_new'               => 'Ajouter une nouvelle sortie',
            'new_item'              => 'Nouvelle sortie',
            'edit_item'             => 'Editer la sortie',
            'update_item'           => 'Mettre à jour la sortie',
            'view_item'             => 'Voir la sortie',
            'view_items'            => 'Voir les sorties',
            'search_items'          => 'Rechercher les sorties',
            'not_found'             => 'Aucune sortie trouvée',
            'not_found_in_trash'    => 'Aucune sortie trouvée dans la corbeille',
            'featured_image'        => 'Image de la sortie',
            'set_featured_image'    => 'Ajouter une image à la sortie',
            'remove_featured_image' => 'Supprimer l\'image de la sortie',
            'use_featured_image'    => 'Utiliser une image pour la sortie',
            'insert_into_item'      => 'Inserer dans la sortie',
            'uploaded_to_this_item' => 'Televerser dans la sortie',
            'items_list'            => 'Liste des sorties',
            'items_list_navigation' => 'Liste des sorties',
            'filter_items_list'     => 'Filtrer la liste des sorties',
        ];

        $args = [
            'labels'                => $labels,
            'description'           => 'Sorties proposées',
            'supports'              => [
                'title',
                'editor',
                'author',
                'thumbnail',
                'excerpt',
                'custom-fields',
                'revisions',
            ],
            'hierarchical'          => false,
            'public'                => true,
            'menu_position'         => 4,
            'menu_icon'             => 'dashicons-location-alt',
            'has_archive'           => true,
            'rewrite'               => [
                'slug'              => 'sortie',
                'with_front'        => true,
                // Exemple d'url avec with_front:
                // http://ocooking.fr/sortie/burger-bien-fat
                // Exemple d'url sans with_front:
                // http://ocooking.fr/burger-bien-fat
            ],
            'capability_type'   => 'outing',
            'map_meta_cap'      => true,
            'show_in_rest'      => true
        ];

        register_post_type('outing', $args);
    }

    public function create_taxo()
    {

        $labels = [
            'name'                       => 'Types',
            'singular_name'              => 'Type',
            'menu_name'                  => 'Types',
            'all_items'                  => 'Tous les types',
            'new_item_name'              => 'Nouveau type',
            'add_new_item'               => 'Ajouter un type',
            'update_item'                => 'Mettre à jour un type',
            'edit_item'                  => 'Editer un type',
            'view_item'                  => 'Voir tous les types',
            'separate_items_with_commas' => 'Séparer les type avec une virgule',
            'add_or_remove_items'        => 'Ajouter une supprimer un type',
            'choose_from_most_used'      => 'Choisir parmis les types les plus utilisés',
            'popular_items'              => 'Types populaires',
            'search_items'               => 'Rechercher un type',
            'not_found'                  => 'Aucun type trouvé',
            'items_list'                 => 'Lister les types',
            'items_list_navigation'      => 'Lister les types',
        ];

        $args = [
            'labels'            => $labels,
            'hierarchical'      => true,
            'public'            => true,
            'capabilities'      => [
                'manage_terms'  => 'edit_outings',
                'edit_terms'    => 'edit_outings',
                'delete_terms'  => 'delete_outings',
                'assign_terms'  => 'edit_outings',
            ]
        ];

        register_taxonomy('type', 'outing', $args);
    }

    public function activation()
    {
        $this->create_cpt();
        $this->create_taxo();

        flush_rewrite_rules();
    }

    public function deactivation()
    {
        flush_rewrite_rules();
    }
}
