var op_asset_settings = (function($){
    return {
        attributes: {
            step_1: {
                video: {
                    type: 'custom_html',
                    html: '<iframe width="400" height="245" src="https://www.youtube.com/embed/kOp7DVgLgmQ" frameborder="0" allowfullscreen></iframe>'
                },
                upsell: {
                    type: 'custom_html',
                    html: OptimizePress.oppp.upsell_box.op_testimonial_slider
                }
            }
        }
    }
}(opjq));
