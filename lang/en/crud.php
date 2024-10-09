<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'payments' => [
        'name' => 'Payments',
        'index_title' => 'Payments List',
        'new_title' => 'New Payment',
        'create_title' => 'Create Payment',
        'edit_title' => 'Edit Payment',
        'show_title' => 'Show Payment',
        'inputs' => [
            'name' => 'Name',
            'icon' => 'Icon',
            'fee_service' => 'Fee Service',
        ],
    ],

    'topics' => [
        'name' => 'Topik',
        'index_title' => 'Daftar Topik',
        'new_title' => 'Topik Baru',
        'create_title' => 'Buat Topik',
        'edit_title' => 'Edit Topik',
        'show_title' => 'Tampilkan Topik',
        'inputs' => [
            'name' => 'Nama',
        ],
    ],

    'address_events' => [
        'name' => 'Alamat',
        'index_title' => 'Daftar Alamat',
        'new_title' => 'Alamat Baru',
        'create_title' => 'Buat Alamat',
        'edit_title' => 'Edit Alamat',
        'show_title' => 'Tampilkan Alamat',
        'inputs' => [
            'address' => 'Alamat',
            'longitude' => 'Longitude',
            'latitutde' => 'Latitude',
            'event_id' => 'Acara',
        ],
    ],

    'topic_mixes' => [
        'name' => 'Topik gabungan',
        'index_title' => 'Daftar Topik gabungan',
        'new_title' => 'Topik gabungan Baru',
        'create_title' => 'Buat Topik gabungan',
        'edit_title' => 'Edit Topik gabungan',
        'show_title' => 'Tampilkan Topik gabungan',
        'inputs' => [
            'topic' => 'Topik Gabungan',
        ],
    ],

    'formats' => [
        'name' => 'Format',
        'index_title' => 'Daftar Format',
        'new_title' => 'Format Baru',
        'create_title' => 'Buat Format',
        'edit_title' => 'Edit Format',
        'show_title' => 'Tampilkan Format',
        'inputs' => [
            'name' => 'Nama',
        ],
    ],

    'transaction_details' => [
        'name' => 'Detail Transaksi',
        'index_title' => 'Daftar Detail Transaksi',
        'new_title' => 'Detail Transaksi Baru',
        'create_title' => 'Buat Detail Transaksi',
        'edit_title' => 'Edit Detail Transaksi',
        'show_title' => 'Tampilkan',
        'inputs' => [
            'quantity' => 'Kuantitas',
            'unit_price' => 'Harga Satuan',
            'total_price' => 'Total Harga',
            'transaction_headers_id' => 'No Catatan Transaksi',
            'ticket_id' => 'Tiket',
        ],
    ],

    'format_mixes' => [
        'name' => 'Format Gabungan',
        'index_title' => 'Daftar Format Gabungan',
        'new_title' => 'Format Gabungan Baru',
        'create_title' => 'Buat Format Gabungan',
        'edit_title' => 'Edit Format Gabungan',
        'show_title' => 'Tampilkan',
        'inputs' => [
            'format' => 'Format Gabungan',
        ],
    ],

    'partners' => [
        'name' => 'Partner',
        'index_title' => 'Daftar Partner',
        'new_title' => 'Partner Baru',
        'create_title' => 'Buat Partner',
        'edit_title' => 'Edit Partner',
        'show_title' => 'Tampilkan Partner',
        'inputs' => [
            'name' => 'Nama',
            'description' => 'Deskripsi',
            'icon' => 'Icon',
        ],
    ],

    'events' => [
        'name' => 'Events',
        'index_title' => 'Events List',
        'new_title' => 'New Event',
        'create_title' => 'Create Event',
        'edit_title' => 'Edit Event',
        'show_title' => 'Show Event',
        'inputs' => [
            'title' => 'Judul',
            'start_at' => 'Mulai',
            'end_at' => 'Berakhir',
            'type' => 'Tipe',
            'slug' => 'Slug',
            'banner' => 'Banner',
            'description' => 'Deskripsi',
            'terms' => 'Ketentuan',
            'city_id' => 'Kota',
            'organizer_id' => 'Organizer',
            'format_mix_id' => 'Format',
            'topic_mix_id' => 'Topik',
        ],
    ],

    'cities' => [
        'name' => 'Kota',
        'index_title' => 'Daftar Kota',
        'new_title' => 'Kota Baru',
        'create_title' => 'Buat Kota',
        'edit_title' => 'Edit Kota',
        'show_title' => 'Tampilkan Kota',
        'inputs' => [
            'city_name' => 'Nama Kota',
        ],
    ],

    'refunds' => [
        'name' => 'Refund',
        'index_title' => 'Daftar efund',
        'new_title' => 'Refund Baru',
        'create_title' => 'Buat Refund',
        'edit_title' => 'Edit Refund',
        'show_title' => 'Tampilkan Refund',
        'inputs' => [
            'date' => 'Tanggal',
            'reason' => 'Alasan',
            'transaction_headers_id' => 'No Catatan Transaksi',
            'status' => 'Status'
        ],
    ],

    'organizers' => [
        'name' => 'Organizers',
        'index_title' => 'Organizers List',
        'new_title' => 'New Organizer',
        'create_title' => 'Create Organizer',
        'edit_title' => 'Edit Organizer',
        'show_title' => 'Show Organizer',
        'inputs' => [
            'name' => 'Nama',
            'icon' => 'Logo',
        ],
    ],

    'tickets' => [
        'name' => 'Tiket',
        'index_title' => 'Daftar Tiket',
        'new_title' => 'Tiket Baru',
        'create_title' => 'Buat Tiket',
        'edit_title' => 'Edit Tiket',
        'show_title' => 'Tampilkan Tiket',
        'inputs' => [
            'name' => 'Nama',
            'description' => 'Deskripsi',
            'price' => 'Harga',
            'min_price' => 'Harga Minimal',
            'quota' => 'Quota',
            'star_sale_at' => 'Mulai Menjuat',
            'end_sale_at' => 'Berakhir Menjual',
            'type' => 'Tipe',
            'event_id' => 'Event',
            'discount' => 'Discount',
            'fee_admin' => 'Fee Admin',
            'tax_coast' => 'Tax Coast',
        ],
    ],

    'contacts' => [
        'name' => 'Kontak',
        'index_title' => 'Daftar Kontak',
        'new_title' => 'Kontak Baru',
        'create_title' => 'Buat Kontak',
        'edit_title' => 'Edit Kontak',
        'show_title' => 'Tampilkan Kontak',
        'inputs' => [
            'name' => 'Nama Lengkap',
            'email' => 'Email',
            'message' => 'Pesan',
        ],
    ],

    'posts' => [
        'name' => 'Artikel',
        'index_title' => 'Daftar Artikel',
        'new_title' => 'Artikel Baru',
        'create_title' => 'Buat Artikel',
        'edit_title' => 'Edit Artikel',
        'show_title' => 'Tampilkan Artikel',
        'inputs' => [
            'title' => 'Judul',
            'slug' => 'Slug',
            'brief-description' => 'Deskripsi Singkat',
            'image' => 'Banner',
            'content' => 'Konten',
            'user_id' => 'Creator',
            'topic_mix_id' => 'Topik',
        ],
    ],

    'users' => [
        'name' => 'User',
        'index_title' => 'Daftar User',
        'new_title' => 'User Baru',
        'create_title' => 'Buat User',
        'edit_title' => 'Edit User',
        'show_title' => 'Tampilkan User',
        'inputs' => [
            'name' => 'Nama',
            'email' => 'Email',
            'phone_number' => 'No Telepon',
            'image' => 'Foto Profile',
            'password' => 'Password',
            'id_google' => 'Google Id',
            'id_facebook' => 'Facebook Id'
        ],
    ],

    'juragans' => [
        'name' => 'Data Juragan',
        'index_title' => 'Data Juragan',
        'new_title' => 'Data Juragan Baru',
        'create_title' => 'Buat Data Juragan',
        'edit_title' => 'Edit Data Juragan',
        'show_title' => 'Tampilkan Data Juragan',
        'inputs' => [
            'address' => 'Alamat',
            'email' => 'Email',
            'phone_number' => 'No Telepon',
            'copyright_text' => 'Teks Copyright',
            'coordinate' => 'Koordinat',
            'short_description' => 'Deskripsi Singkat',
            'long_description' => 'Deskripsi Panjang',
            'contact_description' => 'Deskripsi Kontak',
            'banner_website' => 'Banner Website',
            'facebook' => 'Link Facebook',
            'youtube' => 'Link Youtube',
            'instagram' => 'Link Instagram',
            'twitter' => 'Link Twitter',
            'logo_website' => 'Logo',
        ],
    ],

    'all_transaction_headers' => [
        'name' => 'Catatan Transaksi',
        'index_title' => 'Daftar Catatan Transaksi',
        'new_title' => 'Catatan Transaksi Baru',
        'create_title' => 'Buat Catatan Transaksi',
        'edit_title' => 'Edit Catatan Transaksi',
        'show_title' => 'Tampilakan Catatan Transaksi',
        'inputs' => [
            'transaction_date' => 'Tanggal Transaksi',
            'no_transaction' => 'No Transaksi',
            'total_transaction' => 'Total Transaksi',
            'status' => 'Status',
            'event_id' => 'Acara',
            'user_id' => 'Pembeli',
            'payment_id' => 'Pembayaran',
            'proof_payments' => 'Bukti Pembayaran',
        ],
    ],

    'galeries' => [
        'name' => 'Galeri',
        'index_title' => 'Daftar Galeri',
        'new_title' => 'Galeri Baru',
        'create_title' => 'Buat Galeri',
        'edit_title' => 'Edit Galeri',
        'show_title' => 'Tampilkan Galeri',
        'inputs' => [
            'image' => 'Gambar',
            'caption' => 'Caption',
            'description' => 'Deskripsi',
        ],
    ],

    'all_visitors' => [
        'name' => 'Visitor',
        'index_title' => 'Daftar Visitor',
        'new_title' => 'New Visitors',
        'create_title' => 'Buat Visitor',
        'edit_title' => 'Edit Visitor',
        'show_title' => 'Tampilkan Visitor',
        'inputs' => [
            'post_id' => 'Post Id',
            'ip_address' => 'Ip Address',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
