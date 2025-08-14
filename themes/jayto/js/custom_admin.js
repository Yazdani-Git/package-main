jQuery(document).ready(function ($) {
    jQuery('.rb_header span').on('click', function () {
        let $this = jQuery(this);
        let status = $this.data('os');
    })
    // jQuery(document).on('click', '.hot_order_edit_bot', function () {
    //     let $this = jQuery(this);
    //     let oi = $this.data('oitrm');
    //     jQuery.ajax({
    //         url: ajax_data.adju,
    //         type: "POST",
    //         data: {action: "get_order_info", 'oi': oi},
    //         beforeSend: function () {
    //         },
    //         success: function (data) {
    //             // let parsedJson = jQuery.parseJSON(data);
    //             jQuery('.order_show_comp').html(data);
    //             jQuery('.order_show_comp').css({'opacity': '1', 'visibility': 'visible'})
    //         }
    //
    //     })
    //
    // })
    jQuery(document).on('click', '.hot_show_info', function () {

        let $this = jQuery(this);
        let oi = $this.data('oitrm');
        jQuery.ajax({
            url: ajax_data.adju,
            type: "POST",
            data: {action: "show_hotel_info", 'oi': oi},
            beforeSend: function () {
            },
            success: function (data) {
                // let parsedJson = jQuery.parseJSON(data);
                jQuery('.order_show_comp').html(data);
                jQuery('.order_show_comp').css({'opacity': '1', 'visibility': 'visible'})
            }

        })

    })
    jQuery(document).on('click', '.order_edit_bot', function () {
        let $this = jQuery(this);
        let oi = $this.data('oitrm');
        jQuery.ajax({
            url: ajax_data.adju,
            type: "POST",
            data: {action: "get_order_info", 'oi': oi},
            beforeSend: function () {
            },
            success: function (data) {
                // let parsedJson = jQuery.parseJSON(data);
                jQuery('.order_show_comp').html(data);
                jQuery('.order_show_comp').css({'opacity': '1', 'visibility': 'visible'})
            }

        })

    })
    jQuery(document).on('click', '.hot_order_edit_bot', function () {
        let $this = jQuery(this);
        let oi = $this.data('oitrm');
        jQuery.ajax({
            url: ajax_data.adju,
            type: "POST",
            data: {action: "get_hot_order_info", 'oi': oi},
            beforeSend: function () {
            },
            success: function (data) {
                // let parsedJson = jQuery.parseJSON(data);
                jQuery('.order_show_comp').html(data);
                jQuery('.order_show_comp').css({'opacity': '1', 'visibility': 'visible'})
            }

        })

    })
    jQuery(document).on('click', '.order_tedit_bot', function () {
        let $this = jQuery(this);
        let oi = $this.data('oitrm');
        jQuery.ajax({
            url: ajax_data.adju,
            type: "POST",
            data: {action: "get_torder_info", 'oi': oi},
            beforeSend: function () {
            },
            success: function (data) {
                // let parsedJson = jQuery.parseJSON(data);
                jQuery('.order_show_comp').html(data);
                jQuery('.order_show_comp').css({'opacity': '1', 'visibility': 'visible'})
            }

        })

    })
    jQuery(document).on('click', '.alert_box_close', function () {

        jQuery('.order_show_comp').css({'opacity': '0', 'visibility': 'hidden'})
    })
    jQuery(document).on('click', '.ecom_but', function () {
        let $this = jQuery(this);
        let parent = $this.parents('tbody');
        let child = parent.find('.slide_comment');
        child.slideToggle(0)
    })
    jQuery(document).on('click', '.adm_ord', function () {

        let $this = jQuery(this);
        let status = $this.attr('data-os');
        jQuery('.adm_ord').removeClass('active')
        $this.addClass('active')
        jQuery.ajax({
            url: ajax_data.adju,
            type: "POST",
            data: {action: "get_orders_by_status", 'os': status},
            beforeSend: function () {


            },
            success: function (data) {
                // let parsedJson = jQuery.parseJSON(data);

                jQuery('.rq_box').html(data)

            }

        })
    })
    jQuery(document).on('click', '.adm_ord_hot', function () {

        let $this = jQuery(this);
        let status = $this.attr('data-os');

        jQuery.ajax({
            url: ajax_data.adju,
            type: "POST",
            data: {action: "get_hot_orders_by_status", 'os': status},
            beforeSend: function () {


            },
            success: function (data) {
                // let parsedJson = jQuery.parseJSON(data);
                jQuery('.rq_box').html(data)

            }

        })
    })
    jQuery(document).on('click', '.com_text_save', function () {

        let $this = jQuery(this);
        let parent = $this.parent('td');
        let desc = parent.find('.show_all_comment').val()
        let id = parent.data('id')

        jQuery.ajax({
            url: ajax_data.adju,
            type: "POST",
            data: {action: "edit_comments_down", 'text': desc, 'id': id},
            beforeSend: function () {


            },
            success: function (data) {
                jQuery('.ca_box').append('<p>تغییرات با موفقیت ذخیره شد</p>')
                jQuery('.ca_box').css({'opacity': '1', 'visibility': 'visible'})
            }

        })
    })
    jQuery(document).on('click', '.ca_box_close', function () {
        jQuery('.ca_box').css({'opacity': '0', 'visibility': 'hiden'})
        jQuery('.ca_box p').remove()


    })


    jQuery(document).on('click', '.finc_ord', function () {
        let $this = jQuery(this);
        let status = $this.attr('data-os');
        jQuery.ajax({
            url: ajax_data.adju,
            type: "POST",
            data: {action: "get_finc_by_status", 'os': status},
            beforeSend: function () {


            },
            success: function (data) {
                // let parsedJson = jQuery.parseJSON(data);

                jQuery('.rq_box').html(data)
            }

        })
    })
    jQuery(document).on('click', '.tou_ord', function () {

        let $this = jQuery(this);
        let status = $this.attr('data-os');

        jQuery.ajax({
            url: ajax_data.adju,
            type: "POST",
            data: {action: "get_tour_order_by_status", 'os': status},
            beforeSend: function () {


            },
            success: function (data) {
                // let parsedJson = jQuery.parseJSON(data);
                jQuery('.rq_box').html(data)
            }

        })
    })
    jQuery(document).on('click', '.change_tos', function () {
        let $this = jQuery(this);
        var oi = $this.data('oitrm');
        jQuery.ajax({
            url: ajax_data.adju,
            type: "POST",
            data: {action: "get_tur_ch_temp", 'oi': oi},
            beforeSend: function () {
            },
            success: function (data) {
                jQuery('.chords_form').html(data);

            }

        })
        jQuery('.chords_form').css({'opacity': 1, 'visibility': 'visible'})
    })
    jQuery(document).on('click', '.chord_close', function () {
        jQuery('.chords_form').css({'opacity': 0, 'visibility': 'hidden'})
        jQuery('.chords_form').html('')
    })
    jQuery(document).on('click', '.button_c', function () {
        let $this = jQuery(this);
        var os = $this.data('os');
        var oi = $this.data('oi');

        jQuery.ajax({
            url: ajax_data.adju,
            type: "POST",
            data: {action: "chanhe_tur_status", 'os': os, 'oi': oi},
            beforeSend: function () {


            },
            success: function (data) {
                jQuery('.chords_form').html('<span class="chord_close"><i class="dashicons dashicons-no-alt"></i></span><p>تغییرات با  موفقیت اعمال شد</p>')
            }

        })
    })
});
jQuery(document).on('click', '.adm_not_insert', function () {
    let $this = jQuery(this);
    let ui = $this.data('ui');

    jQuery.ajax({
        url: ajax_data.adju,
        type: "POST",
        data: {action: "get_wallet_pay_notic_temp", 'ui': ui},
        beforeSend: function () {


        },
        success: function (data) {
            // let parsedJson = jQuery.parseJSON(data);
            jQuery('.order_show_comp').html(data);
            jQuery('.order_show_comp').css({'opacity': '1', 'visibility': 'visible'})
        }

    })

})
jQuery(document).on('click', '.adm_view_uinf', function () {
    let $this = jQuery(this);
    let uid = $this.data('uid9989') - 100;

    jQuery.ajax({
        url: ajax_data.adju,
        type: "POST",
        data: {action: "get_user_bank_info", 'uid': uid},
        beforeSend: function () {


        },
        success: function (data) {
            // let parsedJson = jQuery.parseJSON(data);
            jQuery('.order_show_comp').html(data);
            jQuery('.order_show_comp').css({'opacity': '1', 'visibility': 'visible'})
        }

    })

})
jQuery(document).on('click', '.adm_wr_not_submit', function () {
    let $this = jQuery(this);
    let ui = $this.data('ui2225');
    let notic = jQuery('.adm_wr_not_inp').val()
    jQuery.ajax({
        url: ajax_data.adju,
        type: "POST",
        data: {action: "add_wallet_pay_notic", 'ui': ui, 'notic': notic},
        beforeSend: function () {


        },
        success: function (data) {
            // // let parsedJson = jQuery.parseJSON(data);
            jQuery('.order_show_comp').css({'opacity': '0', 'visibility': 'hidden'})
        }

    })

})
jQuery(document).on('click', '.adm_change_rw_status', function () {
    let $this = jQuery(this);
    let ui = $this.data('ui');

    jQuery.ajax({
        url: ajax_data.adju,
        type: "POST",
        data: {action: "get_chrw_temp", 'ui': ui},
        beforeSend: function () {


        },
        success: function (data) {
            // let parsedJson = jQuery.parseJSON(data);
            jQuery('.order_show_comp').html(data);
            jQuery('.order_show_comp').css({'opacity': '1', 'visibility': 'visible'})
        }

    })

})
jQuery(document).on('click', '.chsb', function () {
    let $this = jQuery(this);
    let ui = $this.data('ui2230');
    let oi = $this.data('ch1016');
    let cs = jQuery('.cur_sts').val();

    jQuery.ajax({
        url: ajax_data.adju,
        type: "POST",
        data: {action: "chanhe_rw", 'ui': ui, 'oi': oi},
        beforeSend: function () {


        },
        success: function (data) {
            jQuery.ajax({
                url: ajax_data.adju,
                type: "POST",
                data: {action: "get_finc_by_status", 'os': cs},
                beforeSend: function () {


                },
                success: function (data) {
                    // let parsedJson = jQuery.parseJSON(data);

                    jQuery('.rq_box').html(data)
                }

            })
            jQuery('.order_show_comp').css({'opacity': '0', 'visibility': 'hidden'})
        }

    })

})
jQuery(document).on('click', '.plus_i', function () {
    let $this = jQuery(this);
    let parents = $this.parents('p');
    let elem = parents.find('input');
    let input_val = elem.val();
    elem.val(Number(input_val) + 1)

})

jQuery(document).on('click', '.add_close', function () {

    jQuery('.adiitional_add_box').html('')
    jQuery('.adiitional_add_box').css({'visibility': 'hidden', 'opacity': '0'})

})
jQuery(document).on('click', '.minus_i', function () {
    let $this = jQuery(this);
    let parents = $this.parents('p');
    let elem = parents.find('input');
    let input_val = elem.val();
    if (Number(input_val >= 1)) {
        elem.val(Number(input_val) - 1)
    }


})
jQuery(document).on('click', '.add_room', function () {
    let $this = jQuery(this);
    let pid = $this.data('pid');

    jQuery.ajax({
        url: ajax_data.adju,
        type: "POST",
        data: {action: "get_new_room_template", 'pid': pid},
        beforeSend: function () {


        },
        success: function (data) {
            jQuery('.room_item_box_prbox').append(data)
        }

    })

})
jQuery(document).on('click', '.save_room', function () {
    let $this = jQuery(this);
    let pid = $this.data('pid');
    let parent = $this.parents('.room_pbox ');
    let items = parent.find('.room_item_box_prbox .rooms_inner ');

    items.each(function (index, element) {

        let room_number = jQuery(this).data('rnum');
        let room_name = jQuery(this).find('.room_name').val();
        let room_tip_number = jQuery(this).find('.r_tips_number').val()
        let bed_count = jQuery(this).find('.room_on_bed').val();
        let room_single_bed = jQuery(this).find('.room_single_bed').val();
        let room_Double_bed = jQuery(this).find('.room_Double_bed').val();
        let room_breackfast = jQuery(this).find('.room_breackfast');
        let r_short_desc = jQuery(this).find('.r_short_desc').val();
        let r_gallery = jQuery(this).find('.imageContainer img');
        let gurls = []
        jQuery(r_gallery).each(function () {
            var src = jQuery(this).attr('src');
            var parts = src.split('/');
            var lastThreeParts = parts.slice(-3);
            var url = lastThreeParts.join('/');
            gurls.push(url)
        });

        if (room_breackfast.is(':checked')) {
            room_breackfast = 'on';
        } else {
            room_breackfast = 'off';
        }
        let room_lunch = jQuery(this).find('.room_lunch');
        if (room_lunch.is(':checked')) {
            room_lunch = 'on';
        } else {
            room_lunch = 'off';
        }
        let room_Dinner = jQuery(this).find('.room_Dinner');
        if (room_Dinner.is(':checked')) {
            room_Dinner = 'on';
        } else {
            room_Dinner = 'off';
        }
        let room_normal_price = jQuery(this).find('.room_normal_price').val();
        let room_endWeek_price = jQuery(this).find('.room_endWeek_price').val();


        jQuery.ajax({
            url: ajax_data.adju,
            type: "POST",
            data: {
                action: "hotel_save_rooms",
                'room_number': room_number,
                'pid': pid,
                'room_name': room_name,
                'bed_count': bed_count,
                'room_breackfast': room_breackfast,
                'room_lunch': room_lunch,
                'room_Dinner': room_Dinner,
                'room_normal_price': room_normal_price,
                'room_endWeek_price': room_endWeek_price,
                'room_Double_bed': room_Double_bed,
                'room_single_bed': room_single_bed,
                'r_short_desc': r_short_desc,
                'urls': gurls,
                'room_tip_number': room_tip_number,

            },
            beforeSend: function () {

                jQuery('.save_room ').text('در حال ذخیره سازی')
            },
            success: function (data) {
                jQuery('.save_room ').text('ذخیره')
            }

        })
    })

})
jQuery(document).on('click', '.admin_addSans_bot', function () {

    let $this = jQuery(this);
    let oid = $this.data('oitrm');

    jQuery.ajax({
        url: "../wp-admin/admin-ajax.php",
        type: "POST",
        data: {
            action: "admin_get_dans_template",
            'oid': oid,
        },
        beforeSend: function () {

        },
        success: function (data) {
            jQuery('.order_show_comp').html(data)
            jQuery('.order_show_comp').css({'opacity': 1, 'visibility': 'visible'})


        }

    })

})
jQuery(document).on('click', '.add_private_sans_submit', function () {

    let $this = jQuery(this);
    let parent = $this.parents('.sans_box');
    let dateTime = parent.find('.sans').val()
    let oid = $this.data('oid');

    jQuery.ajax({
        url: "../wp-admin/admin-ajax.php",
        type: "POST",
        data: {
            action: "admin_update_private_sanse_table",
            'oid': oid,
            'dateTime': dateTime,
        },
        beforeSend: function () {

        },
        success: function (data) {

            jQuery('.order_show_comp').css({'opacity': 0, 'visibility': 'hidden'})


        }

    })

})
jQuery(document).on('click', '.amd_alt_close', function () {
    jQuery('.alert_ad_box').css({'display': 'none'})
})
jQuery(document).on('click', '.add_sans_submit_p', function () {

    let $this = jQuery(this);
    let parents = $this.parents('.avtou_itm');
    let data = parents.data('tif');
    jQuery.ajax({
        url: ajax_data.aju,
        type: "POST",
        data: {
            action: "set_tour_session",
            'data': data,
            'request_type': 'private'
        },
        beforeSend: function () {

        },
        success: function (data) {

            // window.location.replace(ajax_data.siteurl + "/tour_reserve");


        }

    })

})
jQuery(document).on('click', '.del_sans', function () {

    let $this = jQuery(this);
    let parents = $this.parents('.sans_item');
    let date_parent = parents.find('.sidate');
    let pa = $this.parent('.sitime')
    let date = date_parent.text().trim()
    let pid = date_parent.attr('data-piind').trim()
    let time = $this.attr('data-time')


    jQuery.ajax({
        url: "../wp-admin/admin-ajax.php",
        type: "POST",
        data: {
            action: "del_sans_admin",
            'date': date,
            'time': time,
            'pid': pid,

        },
        beforeSend: function () {

        },
        success: function (add) {
           
            pa.remove()
        if (add === 'zero'){
            date_parent.remove()
        }

        }

    })

})
jQuery(document).on('click', '.add_aditionam_icon', function () {

    let $this = jQuery(this);
    let tour_id = $this.data('tid')
    jQuery.ajax({
        url: "../wp-admin/admin-ajax.php",
        type: "POST",
        data: {
            action: "get_add_tour_exp_template",
            'tour_id': tour_id,

        },
        beforeSend: function () {

        },
        success: function (data) {
            jQuery('.adiitional_add_box').html(data)
            jQuery('.adiitional_add_box').css({'visibility': 'visible', 'opacity': '1'})
            // window.location.replace(ajax_data.siteurl + "/tour_reserve");


        }

    })

})
jQuery(document).on('click', '.ate_submit', function () {

    let $this = jQuery(this);
    let tour_id = $this.data('tid')
    let parent = $this.parents('.fff')
    let name = parent.find('.add_tour_exp').val()
    let price = parent.find('.add_tour_exp_price').val()
    let base_input = parent.find('.tour_base')
    let base = 0
    if (base_input.prop("checked") == true) {
        base = 1;

    }


    jQuery.ajax({
        url: "../wp-admin/admin-ajax.php",
        type: "POST",
        data: {
            action: "add_tour_variable",
            'tour_id': tour_id,
            'name': name,
            'base': base,
            'price': price,

        },
        beforeSend: function () {

        },
        success: function (data) {
            let result = jQuery.parseJSON(data)
            let check = '';
            if (result.base === '1') {
                check = 'checked'
            }

            jQuery('.adiitional_add_box').css({'visibility': 'hidden', 'opacity': '0'})
            jQuery('.adiitional_inline_box').append('<div class="mbt15 adiibt"> <label>نام اقامتگاه :</label><input type="text" name="add_tour_exp" class="add_tour_exp" value="' + result.title + '"><label>قیمت (تومان) :</label><input type="number" name="tour_price" class="add_tour_exp_price" value="' + result.price + '" ><label>پیش فرض :</label><input type="checkbox" name="tour_base" class="tour_base" ' + check + ' ><span class="dashicons dashicons-update aib_update" data-id="' + result.lid + '"></span><span class="dashicons dashicons-trash aib_delete" data-id="' + result.lid + '" ></span>')
            // window.location.replace(ajax_data.siteurl + "/tour_reserve");


        }

    })

})
jQuery(document).on('click', '.aib_delete', function () {

    let $this = jQuery(this);
    let id = $this.data('id')
    let parent = $this.parents('.adiibt')


    jQuery.ajax({
        url: "../wp-admin/admin-ajax.php",
        type: "POST",
        data: {
            action: "remove_tour_variable",
            'id': id,


        },
        beforeSend: function () {

        },
        success: function (data) {
            parent.remove()

            // window.location.replace(ajax_data.siteurl + "/tour_reserve");


        }

    })

})
jQuery(document).on('click', '.aib_update', function () {

    let $this = jQuery(this);
    let id = $this.data('id')
    let parent = $this.parents('.adiibt')
    let name = parent.find('.add_tour_exp').val()
    let price = parent.find('.add_tour_exp_price').val()
    let base_input = parent.find('.tour_base')
    let base = 0
    if (base_input.prop("checked") == true) {
        base = 1;

    }


    jQuery.ajax({
        url: "../wp-admin/admin-ajax.php",
        type: "POST",
        data: {
            action: "update_tour_variable",
            'id': id,
            'name': name,
            'price': price,
            'base': base,


        },
        beforeSend: function () {

        },
        success: function (data) {
            alert('اطلاعات اقامتگاه با موفقیت بروز شد')

            // window.location.replace(ajax_data.siteurl + "/tour_reserve");


        }

    })

})
jQuery(document).on('click', '.clotag', function () {

    let $this = jQuery(this);
    let parents = $this.parents('.add_priv_box');
    parents.css({'display': 'none'})

})
jQuery(document).on('click', '.ceitm', function () {
    let $this = jQuery(this);
    let order = $this.data('order')
    let id = $this.data('id')
    let $status = 0;

    jQuery.ajax({

        url: ajax_data.adju,
        type: "POST",
        data: {
            action: "edit_comments_admin",
            'order': order,
            'id': id

        },
        beforeSend: function () {

        },
        success: function () {
            jQuery.ajax({

                url: ajax_data.adju,
                type: "POST",
                data: {
                    action: "refresh_coment_html",


                },
                beforeSend: function () {

                },
                success: function (data) {
                    jQuery('.admin_comment_box').html(data)
                    jQuery('.ca_box').append('<p>تغییرات با موفقیت ذخیره شد</p>')
                    jQuery('.ca_box').css({'opacity': '1', 'visibility': 'visible'})
                }

            })

        }

    })


})
jQuery(document).on('click', '.ConfirmStatus', function () {
    let $this = jQuery(this);


    jQuery.ajax({

        url: ajax_data.adju,
        type: "POST",
        data: {
            action: "refresh_coment_html",
            'status': 1,


        },
        beforeSend: function () {

        },
        success: function (data) {
            jQuery('.admin_comment_box').html(data)

        }

    })


})
jQuery(document).on('click', '.noConfirmStatus', function () {
    let $this = jQuery(this);

    jQuery.ajax({

        url: ajax_data.adju,
        type: "POST",
        data: {
            action: "refresh_coment_html",
            'status': 0,


        },
        beforeSend: function () {

        },
        success: function (data) {
            jQuery('.admin_comment_box').html(data)

        }

    })


})
jQuery(document).on("click", "#ticket_select_status", (function () {
    var a = jQuery(this), e = a.val(), t = a.parent(".tss").find(".ticket_id").val();
    jQuery.ajax({
        url: ajax_data.adju,
        type: "POST",
        data: {action: "admin_ticket_change_status", tid: t, status: e},
        beforeSend: function () {
        },
        success: function (a) {
            alert("پاسخ شما ثبت شد.")
        }
    })
}))

jQuery(document).on("click", '.ticket_answer_but', (function () {

    jQuery(this).parents(".admin_row_tr").next(".ticket_answer_tr").slideToggle(500)
}))

jQuery(document).on("click", '.admin_tick_answer', (function (a) {
    jQuery(this).parents(".admin_answer_div").find(".admin_answer-ticket_form").fadeToggle()
}))
jQuery(document).on("click", ".insert_ticket_answer ", (function () {
    var a = jQuery(this), e = a.parents(".admin_answer-ticket_form"), t = e.find(".admin_ans_file").prop("files")[0],
        n = e.find(".admin_answer_text").val(), i = e.find(".ticket_uid").val(), r = e.find(".ticket_id").val(),
        d = new FormData;
    d.append("admin_fileupload", t), d.append("action", "admin_ticket_answer"), d.append("uid", i), d.append("tid", r), d.append("answer", n), "" == n ? alert("فیلد پاسخ نباید خالی باشد") : jQuery.ajax({
        url: ajax_data.adju,
        type: "POST",
        contentType: !1,
        processData: !1,
        data: d,
        beforeSend: function () {
            a.html("در حال ثبت پاسخ ....")
        },
        success: function (e) {
            alert("پاسخ شما ثبت شد."), a.html("در حال ثبت پاسخ ....").html("ثبت پاسخ"), location.reload()
        }
    })
}))
jQuery(document).on("click", ".del_i", (function () {
    let $this = jQuery(this);
    let data = $this.parent('.del_room').data('info')

    jQuery.ajax({
        url: ajax_data.adju,
        type: "POST",
        data: {action: "remove_hotel_room", data: data},
        beforeSend: function () {
        },
        success: function (a) {
            $this.parents('.rooms_inner').remove()
        }
    })
}))
jQuery(document).on('click', '.hadm_operation', function () {

    let $this = jQuery(this);
    let oid = $this.data('oid');
    let res = $this.data('res')
    let status = $this.data('rost')
    let pt = 'hotel'
    if (res === 'res') {
        pt = 'residance'
    }

    jQuery.ajax({
        url: "../wp-admin/admin-ajax.php",
        type: "POST",
        data: {
            action: "get_admin_change_order_status_tmp",
            'oid': oid,
            'res': res,
            'status': status,


        },

        beforeSend: function () {
        },
        success: function (f) {
            jQuery('.order_show_comp').html(f)
            jQuery('.order_show_comp').css({'opacity': 1, 'visibility': 'visible'})
        }
    })


})
jQuery(document).on('click', '.hvroom', function () {

    let $this = jQuery(this);
    let hid = $this.data('hid');
    jQuery.ajax({
        url: "../wp-admin/admin-ajax.php",
        type: "POST",
        data: {
            action: "get_hotel_rooms",
            'hid': hid,


        },

        beforeSend: function () {
        },
        success: function (response) {

            jQuery('.hrvroom_box').html(response)
            jQuery('.hrvroom_box').css({'opacity': 1, 'visibility': 'visible'})
        }
    })


})
jQuery(document).on('click', '.alert_hbox_close', function () {

    let $this = jQuery(this);
    let parent = $this.parents('.hrvroom_box');
    parent.css({'opacity': 0, 'visibility': 'hidden'})

})
jQuery(document).on('click', '.submit_discount', function () {

    let $this = jQuery(this);
    let did = $this.data('did');
    let parents = $this.parents('tr');
    let start_date = parents.find('.start_date').val()
    let end_date = parents.find('.end_date').val()
    let perscent_discount = parents.find('.perscent_discount').val()

    let error = 0;
    if (start_date == '') {
        error = 1;

    }
    if (end_date == '') {
        error = 1;
    }
    if (perscent_discount == '') {
        error = 1;
    }
    if (error == 1) {
        alert('تمام ورودی ها پر کنید')
    }


    jQuery.ajax({
        url: "../wp-admin/admin-ajax.php",
        type: "POST",
        data: {
            action: "add_residance_discount",

            'id': did,
            'start_date': start_date,
            'end_date': end_date,
            'percent_discount': perscent_discount,


        },

        beforeSend: function () {
            $this.text('...')
        },
        success: function (f) {
            $this.text('ثبت تخفیف')
            alert('تخفیف برای اقامتگاه مورد نظر ثبت شد.')
        }
    })


})
jQuery(document).on('click', '.submit_room_discount', function () {

    let $this = jQuery(this);
    let hid = $this.data('hid');
    let rid = $this.data('rid');
    let parents = $this.parents('tr');
    let start_date = parents.find('.start_date').val()
    let end_date = parents.find('.end_date').val()
    let perscent_discount = parents.find('.perscent_discount').val()

    let error = 0;
    if (start_date == '') {
        error = 1;

    }
    if (end_date == '') {
        error = 1;
    }
    if (perscent_discount == '') {
        error = 1;
    }
    if (error == 1) {
        alert('تمام ورودی ها پر کنید')
    }


    jQuery.ajax({
        url: "../wp-admin/admin-ajax.php",
        type: "POST",
        data: {
            action: "add_room_discount",

            'hid': hid,
            'rid': rid,
            'start_date': start_date,
            'end_date': end_date,
            'percent_discount': perscent_discount,


        },

        beforeSend: function () {
            $this.text('...')
        },
        success: function (f) {
            $this.text('ثبت تخفیف')
            alert('تخفیف برای اقامتگاه مورد نظر ثبت شد.')
        }
    })


})

jQuery(document).on('click', '.adm_ret', function () {

    let $this = jQuery(this);
    let iod = $this.data('oid');
    let post_type = $this.data('pt');
    var pt = 'hotel'
    if (post_type == 'res') {
        pt = 'residance';
    }


    jQuery.ajax({
        url: "../wp-admin/admin-ajax.php",
        type: "POST",
        data: {
            action: "admin_change_order_status",
            'oid': iod,
            'os': '3',
            'pt': pt
        },

        beforeSend: function () {
        },
        success: function (f) {
            jQuery('.order_show_comp').css({'opacity': 0, 'visibility': 'hidden'})
            location.reload()
        }

    })

})

jQuery(document).on('click', '.cart_ret', function () {
    let $this = jQuery(this);
    let iod = $this.data('oid');
    let post_type = $this.data('pt');
    var pt = 'hotel'
    if (post_type == 'res') {
        pt = 'residance';
    }
    jQuery.ajax({
        url: "../wp-admin/admin-ajax.php",
        type: "POST",
        data: {
            action: "admin_change_order_status_cart_return",
            'oid': iod,
            'os': '3',
            'pt': pt
        },
        beforeSend: function () {
        },
        success: function (f) {
            jQuery('.order_show_comp').css({'opacity': 0, 'visibility': 'hidden'})
            location.reload()
        }
    })
})
jQuery(document).on('click', '.cart_accp', function () {
    let $this = jQuery(this);
    let iod = $this.data('oid');
    let pt = 'hotel'
    let post_type = $this.data('pt');
    let sts = $this.data('rost');
    let status = 10;
    if (sts == 1) {
        status = 4;
    }
    if (sts == 12) {
        status = 10;
    }
    if (post_type == 'res') {
        pt = 'residance';
    }
    jQuery.ajax({
        url: "../wp-admin/admin-ajax.php",
        type: "POST",
        data: {
            action: "admin_change_order_status",
            'oid': iod,
            'os': status,
            'pt': pt,
            'update_wallet': 'ok'
        },
        beforeSend: function () {
        },
        success: function (f) {
            jQuery('.order_show_comp').css({'opacity': 0, 'visibility': 'hidden'})
            location.reload()
        }
    })

})
jQuery(document).on('click', '.adm_accp', function () {

    let $this = jQuery(this);
    let iod = $this.data('oid');
    let pt = 'hotel'
    let post_type = $this.data('pt');
    let os = $this.data('os');
    // let os_send = 4;
    // if (os === 12) {
    //     os_send = 10;
    // }
    if (post_type == 'res') {
        pt = 'residance';
    }
    jQuery.ajax({
        url: "../wp-admin/admin-ajax.php",
        type: "POST",
        data: {
            action: "admin_change_order_status_for_request",
            'oid': iod,
            'os': os,
            'pt': pt
        },

        beforeSend: function () {
        },
        success: function (f) {
            jQuery('.order_show_comp').css({'opacity': 0, 'visibility': 'hidden'})
            location.reload()
        }

    })

})
jQuery(document).on('click', '.request_ret', function () {
    let $this = jQuery(this);
    let iod = $this.data('oid');
    let post_type = $this.data('pt');
    let os = $this.data('os');
    var pt = 'hotel'
    if (post_type == 'res') {
        pt = 'residance';
    }

    jQuery.ajax({
        url: "../wp-admin/admin-ajax.php",
        type: "POST",
        data: {
            action: "admin_change_order_status_for_request",
            'oid': iod,
            'os': os,
            'pt': pt
        },
        beforeSend: function () {
        },
        success: function (f) {
            jQuery('.order_show_comp').css({'opacity': 0, 'visibility': 'hidden'})
            location.reload()
        }
    })
})
jQuery(document).on('click', '.request_accp', function () {
    let $this = jQuery(this);
    let iod = $this.data('oid');
    let post_type = $this.data('pt');
    let os = $this.data('os');
    var pt = 'hotel'
    if (post_type == 'res') {
        pt = 'residance';
    }

    jQuery.ajax({
        url: "../wp-admin/admin-ajax.php",
        type: "POST",
        data: {
            action: "admin_change_order_status_for_request",
            'oid': iod,
            'os': os,
            'pt': pt
        },
        beforeSend: function () {
        },
        success: function (f) {
            jQuery('.order_show_comp').css({'opacity': 0, 'visibility': 'hidden'})
            location.reload()
        }
    })
})

jQuery(document).on('click', '.chrr_btn', function () {

    let $this = jQuery(this);
    let iod = $this.data('oid');
    let new_room_id = jQuery('#change_res_room').val()

    jQuery.ajax({
        url: "../wp-admin/admin-ajax.php",
        type: "POST",
        data: {
            action: "change_admin_hotel_room",
            'oid': iod,
            'new_room_id': new_room_id,

        },

        beforeSend: function () {

            jQuery('.chrr_btn').text('...')
        },
        success: function (f) {
            jQuery('.order_show_comp').html(f)
        }

    })

})
jQuery(document).on('click', '.adm_add_wallet_submit', function () {

    let $this = jQuery(this);
    let mobile_number = jQuery('.user_mobile').val()
    let amount = jQuery('.up_wallet_amount').val();

    jQuery.ajax({
        url: "../wp-admin/admin-ajax.php",
        type: "POST",
        data: {
            action: "adm_update_wallet",
            'mobile_number': mobile_number,
            'amount': amount
        },

        beforeSend: function () {
        },
        success: function (f) {
            jQuery('.aawb_body').html(f)
        }

    })

})
jQuery(document).on('click', '.adm_low_wallet_submit', function () {

    let $this = jQuery(this);
    let mobile_number = jQuery('.user_mobile').val()
    let amount = jQuery('.up_wallet_amount').val();

    jQuery.ajax({
        url: "../wp-admin/admin-ajax.php",
        type: "POST",
        data: {
            action: "adm_update_wallet_low",
            'mobile_number': mobile_number,
            'amount': amount
        },

        beforeSend: function () {
        },
        success: function (f) {
            jQuery('.aawb_body').html(f)
        }

    })

})
jQuery(document).on('click', '.wallet_button', function () {
    let $this = jQuery(this);
    let price = $this.find('.wl_price_inp').val();
    jQuery('.wallet_inp').val(price)


})
jQuery(document).on('click', '.adm_up_wallet_btn', function () {

    let $this = jQuery(this);
    let parent = $this.parents('.bif_adw');
    let mobile_number = parent.find('.user_mobile').val()


    jQuery.ajax({
        url: "../wp-admin/admin-ajax.php",
        type: "POST",
        data: {
            action: "get_user_wallet_add",
            'mobile_number': mobile_number,


        },

        beforeSend: function () {


        },
        success: function (f) {
            jQuery('.aawb_body').html(f)
        }

    })

})
jQuery(document).on('click', '.adm_check_user_note', function () {

    let $this = jQuery(this);
    let parent = $this.parents('.bif_adw');
    let mobile_number = parent.find('.user_mobile').val()


    jQuery.ajax({
        url: "../wp-admin/admin-ajax.php",
        type: "POST",
        data: {
            action: "get_user_noti_add",
            'mobile_number': mobile_number,


        },

        beforeSend: function () {


        },
        success: function (f) {
            jQuery('.aawb_body').html(f)
        }

    })

})
jQuery(document).on('click', '.noti_send', function () {

    let $this = jQuery(this);
    let uid = $this.data('id');
    let parent = $this.parents('.noti_desc');
    let desc = parent.find('.noti_body').val()

    jQuery.ajax({
        url: "../wp-admin/admin-ajax.php",
        type: "POST",
        data: {
            action: "add_noti_to_user",
            'desc': desc,
            'uid': uid,


        },

        beforeSend: function () {


        },
        success: function (f) {
            jQuery('.last_notification').prepend('<div class="each_note"><span>' + desc + '</span> <span data-id="' + f + '" data-uid="' + uid + '" class=" del_note dashicons dashicons-trash"></span></div>')
        }

    })

})
jQuery(document).on('click', '.del_note', function () {

    let $this = jQuery(this);
    let parent = $this.parents('.each_note')
    let id = $this.data('id');
    let uid = $this.data('uid');


    jQuery.ajax({
        url: "../wp-admin/admin-ajax.php",
        type: "POST",
        data: {
            action: "delete_user_not",
            'id': id,
            'uid': uid,


        },

        beforeSend: function () {


        },
        success: function (f) {
            parent.remove();
        }

    })

})
jQuery(document).ready(function ($) {
    $('.upload_button').on('click', function (e) {
        e.preventDefault();

        var uploader = $(this).closest('.uploader');
        var fileInput = uploader.find('.file_input')[0].files;
        var formData = new FormData();

        for (var i = 0; i < fileInput.length; i++) {
            formData.append('file[]', fileInput[i]);
        }

        formData.append('action', 'rooms_upload_images');

        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                var images = JSON.parse(response);

                displayImages(uploader, images);
            }
        });
    });

    function displayImages(uploader, images) {
        var imageContainer = uploader.find('.imageContainer');


        if (images.length > 0) {
            images.forEach(function (imageUrl) {
                imageContainer.append('<div class="imageC_box"><img src="' + imageUrl + '"></div>');
            });
        } else {
            imageContainer.append('<p>No images uploaded</p>');
        }
    }
});
jQuery(document).ready(function ($) {
    $('.room_gall_close').on('click', function (e) {
        let parent = $(this).parents('.imageC_box');
        let src = parent.find('img').attr('src');

        $.ajax({
            url: "../wp-admin/admin-ajax.php",
            type: 'POST',
            data: {
                image_url: src,
                action: "delete_rooms_image",
            },
            success: function (response) {
                // دریافت پاسخ از سمت سرور و نمایش آن در باکس

                parent.remove()
            }
        });
    });

    // بستن باکس با کلیک روی آن

});