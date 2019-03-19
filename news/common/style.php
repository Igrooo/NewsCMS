<?php
echo'<style>
        #'.$query.' .ReadMsgBody { width: 100%; background-color: #ffffff;}
        #'.$query.' .ExternalClass {width: 100%; background-color: #ffffff;}
        #'.$query.' .ExternalClass,
        #'.$query.' .ExternalClass p,
        #'.$query.' .ExternalClass span,
        #'.$query.' .ExternalClass font,
        #'.$query.' .ExternalClass td,
        #'.$query.' .ExternalClass div {line-height:100%;}
        #'.$query.' #fakebody {-webkit-text-size-adjust:none; -ms-text-size-adjust:none; margin:0; padding:0; text-align:center;}
        #'.$query.' table {border-spacing:0;}
        #'.$query.' table td {border-collapse:collapse;}
        #'.$query.' td.hnedt > div,
        #'.$query.' td.hnedt div > button{display: table !important;}
        #'.$query.' .yshortcuts a {border-bottom: none !important;}
        #'.$query.' img{height:auto !important;}

        .responsive-view #'.$query.' #fakebody{width:auto!important;}
        .responsive-view #'.$query.' table[class="container"]{
            width: 100%!important;
            padding-left:10px !important;
            padding-right:10px !important;
        }
        .responsive-view #'.$query.' table[class="full-width"]{
            width:100% !important;
            float:left !important;
        }
        .responsive-view #'.$query.' table[class="width-95-percent"]{width:95% !important;}
        .responsive-view #'.$query.' table[class="width-220"]{width:220px !important;}
        .responsive-view #'.$query.' td[class="width-50-percent"]{width:50% !important;}
        .responsive-view #'.$query.' td[class="width-25"]{width:25px !important;}
        .responsive-view #'.$query.' td[class="width-100"]{width:100px !important;}
        .responsive-view #'.$query.' td[class="display-table-cell"]{
            display: table-cell !important;
            max-width: none !important;
            visibility: visible !important;
        }
        .responsive-view #'.$query.' table[class="remove"]{display:none !important;}
        .responsive-view #'.$query.' tr[class="remove"]{display:none !important;}
        .responsive-view #'.$query.' td[class="remove"]{display:none !important;}
        .responsive-view #'.$query.' table[class="menu-float-center"]{
            width: 90% !important;
            margin-left: 5% !important;
            margin-right: 5% !important;
            text-align: center !important;
        }
        .responsive-view #'.$query.' td[class="text-center"]{text-align: center !important;}
        .responsive-view #'.$query.' td[class="font-size-18"]{font-size: 18px !important;}
        .responsive-view #'.$query.' td[class="font-size-22"]{font-size: 22px !important; line-height: 18px !important}
        .responsive-view #'.$query.' td[class="font-size-28"]{font-size: 28px !important; line-height: 24px !important}
        .responsive-view #'.$query.' img[class="image-responsive"]{
            width:100% !important;
            margin:0 !important;
            height: auto !important;
            max-width: 100% !important;
        }
        .responsive-view #'.$query.' img[class="image-width-20"]{width:20px !important;}
        .responsive-view #'.$query.' span.mobile-lien-blanc a{
            color: #ffffff !important;
            text-decoration: none;
        }
        
        @media screen and (max-width: 790px) {
             #'.$query.' #fakebody{width:auto!important;}
             #'.$query.' table[class="container"]{
                width: 100%!important;
                padding-left:10px !important;
                padding-right:10px !important;
            }
             #'.$query.' table[class="full-width"]{
                width:100% !important;
                float:left !important;
            }
             #'.$query.' table[class="width-95-percent"]{width:95% !important;}
             #'.$query.' table[class="width-220"]{width:220px !important;}
             #'.$query.' td[class="width-50-percent"]{width:50% !important;}
             #'.$query.' td[class="width-25"]{width:25px !important;}
             #'.$query.' td[class="width-100"]{width:100px !important;}
             #'.$query.' td[class="display-table-cell"]{
                display: table-cell !important;
                max-width: none !important;
                visibility: visible !important;
            }
             #'.$query.' table[class="remove"]{display:none !important;}
             #'.$query.' tr[class="remove"]{display:none !important;}
             #'.$query.' td[class="remove"]{display:none !important;}
             #'.$query.' table[class="menu-float-center"]{
                width: 90% !important;
                margin-left: 5% !important;
                margin-right: 5% !important;
                text-align: center !important;
            }
             #'.$query.' td[class="text-center"]{text-align: center !important;}
             #'.$query.' td[class="font-size-18"]{font-size: 18px !important;}
             #'.$query.' td[class="font-size-22"]{font-size: 22px !important; line-height: 18px !important}
             #'.$query.' td[class="font-size-28"]{font-size: 28px !important; line-height: 24px !important}
             #'.$query.' img[class="image-responsive"]{
                width:100% !important;
                margin:0 !important;
                height: auto !important;
                max-width: 100% !important;
            }
             #'.$query.' img[class="image-width-20"]{width:20px !important;}
             #'.$query.' span.mobile-lien-blanc a{
                color: #ffffff !important;
                text-decoration: none;
            }
        }
        
        #newsletter-builder img[src^="'.CURRENT_DIR.FOLDER_PLACEHOLDER.'"],
        #newsletter-editor img[src^="'.CURRENT_DIR.FOLDER_PLACEHOLDER.'"]{
            filter: saturate(0%);
            transition: filter 250ms;
        }
        #newsletter-builder img[src^="'.CURRENT_DIR.FOLDER_PLACEHOLDER.'"]:hover,
        #newsletter-editor .focused img[src^="'.CURRENT_DIR.FOLDER_PLACEHOLDER.'"],
        #newsletter-editor img[src^="'.CURRENT_DIR.FOLDER_PLACEHOLDER.'"]:hover{
            filter: saturate(80%);
        }
    </style>
';