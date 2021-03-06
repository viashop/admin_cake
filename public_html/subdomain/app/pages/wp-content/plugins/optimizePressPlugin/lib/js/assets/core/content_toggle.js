var op_asset_settings = (function ($) {
    return {
        help_vids: {
            step_1: {
                url: 'http://op2-inapp.s3.amazonaws.com/elements-content-toggle.mp4',
                width: '600',
                height: '341'
            },
            step_2: {
                url: 'http://op2-inapp.s3.amazonaws.com/elements-content-toggle.mp4',
                width: '600',
                height: '341'
            },
            step_3: {
                url: 'http://op2-inapp.s3.amazonaws.com/elements-content-toggle.mp4',
                width: '600',
                height: '341'
            }
        },
        attributes: {
            step_1: {
                style: {
                    type: 'style-selector',
                    folder: 'previews',
                    addClass: 'op-disable-selected'
                }
            },
            step_2: {
                label: {
                    title: 'content_toggle_label',
                    default_value: 'Show'
                },
                hide_label: {
                    title: 'content_toggle_hide_label',
                    default_value: 'Hide'
                },
                content: {
                    title: 'content',
                    type: 'wysiwyg',
                    addClass: 'op-hidden-in-edit'
                }
            },
            step_3: {
                microcopy: {
                    text: 'content_toggle_advanced1',
                    type: 'microcopy'
                },
                microcopy2: {
                    text: 'advanced_warning_2',
                    type: 'microcopy',
                    addClass: 'warning'
                },
                font: {
                    title: 'content_toggle_font_settings',
                    type: 'font'
                }
            }
        },
        insert_steps: {2:{next:'advanced_options'},3:true}
    };
}(opjq));