(function() {
    tinymce.create('tinymce.plugins.dms3Restaurant',{
        init : function(ed,url) {
            ed.addButton('dms3RestaurantEco',{
                title:      'Eco',
                image:       url + '/icon-eco.png',
                onclick:    function() {
                    ed.execCommand(
                        "mceInsertContent",
                        false,
                        "[eco]"
                        );
                }
            });
            ed.addButton('dms3RestaurantVeg',{
                title:      'Veg',
                image:      url + '/icon-veg.png',
                onclick:    function() {
                    ed.execCommand(
                        "mceInsertContent",
                        false,
                        "[veg]"
                        );
                }
            });
            ed.addButton('dms3RestaurantPrice',{
                title:      'Price',
                image:      url + '/icon-price.png',
                onclick:    function() {
                    ed.execCommand(
                        "mceInsertContent",
                        false,
                        "[P 99,99&euro;]"
                        );    
                }
            });

        },
        
        getInfo : function() {
            return {
                longname:   'DeMomentSomTres Restaurant',
                author:     'Marc Queralt',
                authorurl:  'http://demomentsomtres.com/',
                infourl:    'http://demomentsomtres.com/english/wordpress-plugin-restaurant/',
                version:    '1.0'
            };
        }
    });
    tinymce.PluginManager.add('dms3Restaurant',tinymce.plugins.dms3Restaurant);
})();