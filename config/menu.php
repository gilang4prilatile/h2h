<?php

return [
    [
        "url" => "dashboard",
        "name" => "Dashboard",
        "icon" => "iconizer",
        "actions" => [
            "index"
        ],
    ],
    [
        "url" => "#",
        "name" => "Master Data",
        "childs" => [
            [
                "url" => "country",
                "name" => "Country",
                "actions" => [
                    "index",
                    "create",
                    "edit",
                    "delete",
                ],
            ],
            [
                "url" => "kppbc",
                "name" => "KPPBC",
                "actions" => [
                    "index",
                    "create",
                    "edit",
                    "delete",
                ],
            ],
            [
                "url" => "jenis-tpb",
                "name" => "Jenis TPB",
                "actions" => [
                    "index",
                    "create",
                    "edit",
                    "delete",
                ],
            ],
            [
                "url" => "tujuan-pengiriman",
                "name" => "Tujuan Pengiriman",
                "actions" => [
                    "index",
                    "create",
                    "edit",
                    "delete",
                ],
            ],
            [
                "url" => "tpb",
                "name" => "Pengusaha TPB / Owner",
                "actions" => [
                    "index",
                    "create",
                    "edit",
                    "delete",
                ],
            ],
            [
                "url" => "pengirim-barang",
                "name" => "Pengirim Barang",
                "actions" => [
                    "index",
                    "create",
                    "edit",
                    "delete",
                ],
            ],
            [
                "url" => "package",
                "name" => "Package",
                "actions" => [
                    "index",
                    "create",
                    "edit",
                    "delete",
                ],
            ],
            [
                "url" => "uom",
                "name" => "Uom",
                "actions" => [
                    "index",
                    "create",
                    "edit",
                    "delete",
                ],
            ],
            [
                "url" => "document",
                "name" => "Document",
                "actions" => [
                    "index",
                    "create",
                    "edit",
                    "delete",
                ],
            ],
            [
                "url" => "warehouse",
                "name" => "Warehouse",
                "actions" => [
                    "index",
                    "create",
                    "edit",
                    "delete",
                ],
            ],
            [
                "url" => "identitas",
                "name" => "Identitas",
                "actions" => [
                    "index",
                    "create",
                    "edit",
                    "delete",
                ],
            ],
            [
                "url" => "api",
                "name" => "Api",
                "actions" => [
                    "index",
                    "create",
                    "edit",
                    "delete",
                ],
            ],
            [
                "url" => "valas",
                "name" => "Valas",
                "actions" => [
                    "index",
                    "create",
                    "edit",
                    "delete",
                ],
            ],
            [
                "url" => "importir",
                "name" => "Importir",
                "actions" => [
                    "index",
                    "create",
                    "edit",
                    "delete",
                ],
            ],
            [
                "url" => "ppjk",
                "name" => "PPJK",
                "actions" => [
                    "index",
                    "create",
                    "edit",
                    "delete",
                ],
            ],
            [
                "url" => "client",
                "name" => "Client",
                "actions" => [
                    "index",
                    "create",
                    "edit",
                    "delete",
                ],
            ],
        ],
    ],
    [
        "url" => "#",
        "name" => "Inbound",
        "childs" => [
            [
                "url" => "bc-23",
                "name" => "BC-23",
                "actions" => [
                    "index",
                    "create",
                    "edit",
                    "delete"
                ],
            ],
            [
                "url" => "bc-27",
                "name" => "BC-27",
                "actions" => [
                    "index",
                    "create",
                    "edit",
                    "delete"
                ],
            ],
            [
                "url" => "bc-40",
                "name" => "BC-40",
                "actions" => [
                    "index",
                    "create",
                    "edit",
                    "delete"
                ],
            ],
        ],

    ],
    [
        "url" => "#",
        "name" => "HS",
        "icon" => "iconizer",
        "childs" => [
            [
                "url" => "bag",
                "name" => "Bag",
                "actions" => [
                    "index",
                    "create",
                    "edit",
                    "delete"
                ],
            ],
            [
                "url" => "bab",
                "name" => "Bab",
                "actions" => [
                    "index",
                    "create",
                    "edit",
                    "delete"
                ],
            ],
            [
                "url" => "sub-pos-asean",
                "name" => "Sub Pos Asean",
                "actions" => [
                    "index",
                    "create",
                    "edit",
                    "delete"
                ],
            ],
            [
                "url" => "pos",
                "name" => "Pos",
                "actions" => [
                    "index",
                    "create",
                    "edit",
                    "delete"
                ],
            ],
            [
                "url" => "sub-pos",
                "name" => "Sub Pos",
                "actions" => [
                    "index",
                    "create",
                    "edit",
                    "delete"
                ],
            ],
            [
                "url" => "hs-code",
                "name" => "HS Code",
                "actions" => [
                    "index",
                    "create",
                    "edit",
                    "delete"
                ],
            ],
            [
                "url" => "reg-name",
                "name" => "Reg Name",
                "actions" => [
                    "index",
                    "create",
                    "edit",
                    "delete"
                ],
            ],
            [
                "url" => "regulation",
                "name" => "Regulation",
                "actions" => [
                    "index",
                    "create",
                    "edit",
                    "delete"
                ],
            ],
        ],
    ],
    [
        "url" => "#",
        "name" => "Outbound",
        "childs" => [
            [
                "url" => "bc-25",
                "name" => "BC-25",
                "actions" => [
                    "index",
                    "create",
                    "edit",
                    "delete"
                ],
            ],
            [
                "url" => "bc-41",
                "name" => "BC-41",
                "actions" => [
                    "index",
                    "create",
                    "edit",
                    "delete"
                ],
            ],
            [
                "url" => "bc-30",
                "name" => "BC-30",
                "actions" => [
                    "index",
                    "create",
                    "edit",
                    "delete"
                ],
            ],
        ],

    ],
    [
        "url" => "#",
        "name" => "Inventory",
        "childs" => [
            [
                "url" => "header",
                "name" => "Header",
                "actions" => [
                    "index",
                    "view",
                ],
            ],
            [
                "url" => "detail",
                "name" => "Detail",
                "actions" => [
                    "index",
                ],
            ],
            [
                "url" => "konversi",
                "name" => "Master Data Konversi",
                "actions" => [
                    "index",
                ],
            ],
        ],
    ],
    [
        "url" => "#",
        "name" => "User Administration",
        "childs" => [
            [
                "url" => "role",
                "name" => "Role",
                "actions" => [
                    "index",
                    "create",
                    "edit",
                    "delete",
                ],
            ],
            [
                "url" => "user",
                "name" => "User",
                "actions" => [
                    "index",
                    "create",
                    "edit",
                    "delete",
                ],
            ],
        ],
    ],
];
