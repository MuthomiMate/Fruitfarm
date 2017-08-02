    $(document).ready( function(){
      $('.btn-minus').click( function(){
        toggleValues(this, 'minus');
      });
      
      $('.btn-plus').click( function(){
        toggleValues(this, 'plus');
      });

      $('.btn-clear').click( function(){
        $('.item-qty').html('0');
        $('.item-total').html('0');
        $('.item-total').attr('title', '0');
        $('.total-amount').html('0');
      });

      Number.prototype.formatMoney = function(c, d, t){
        var n = this, 
          c = isNaN(c = Math.abs(c)) ? 2 : c, 
          d = d == undefined ? "." : d, 
          t = t == undefined ? "," : t, 
          s = n < 0 ? "-" : "", 
          i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", 
          j = (j = i.length) > 3 ? j % 3 : 0;
          return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
      };

      //check if order items prev set
      var set_items = $('#set-items').val();
      if($.trim(set_items) != '')
      { 
        set_items = set_items.split('|');
        for(var s=0; s<set_items.length; s++)
        {
          var item_parts = set_items[s].split(',');
          var times = parseInt(item_parts[1]);
          for (var t=0; t<times; t++) {
            $('.plus-'+item_parts[0]).trigger('click');
          };
        }
      }


      $('#send').on('click', function(e) {
        e.preventDefault();
        // var form = $('#orderB');
           
        var values = {};
        $('td input').each(function(){
                values[$(this).attr('name')] = $(this).val();
        })

        console.log(values);

      });



    });

    function toggleValues(btn, opt)
    {
        var parent_ = $(btn).parent();
        container_ = $(parent_).parent();

        var item_qty = container_.find('.item-qty');
        item_qty_val = parseInt(item_qty.html());
        var item_cost = container_.find('.item-cost');
        var item_total = container_.find('.item-total');

        var item_name = container_.find('.item-name').html();
        var item_type = container_.find('.item-type').val();
        var item_id = container_.find('.item-id').val();

        if(opt == 'minus')
        {
          if(item_qty_val > 0)
          {
            item_qty_val --;
            item_qty.html(item_qty_val);
          }
        }
        if(opt == 'plus')
        {
            item_qty_val ++;
            item_qty.html(item_qty_val);
        }

        var item_total_val = item_qty_val * parseFloat(item_cost.html());
        //item_total.val('title', item_total_val);

        //item_total_val = item_total_val.formatMoney(0, '.', ',');
        item_total.val(item_total_val);

        var total_amount = 0;
        $('.item-total').each( function(){
          var each_item_total = parseFloat($(this).val());
          if(!isNaN(each_item_total))
            total_amount += each_item_total;
        });
        $('.total-amount').html(total_amount.formatMoney(0, '.', ','));

        var total_qty = 0;
        $('.item-qty').each( function(){
          var each_total_qty = parseInt($(this).html());
          if(!isNaN(each_total_qty))
            total_qty += each_total_qty;
        });
        $('.total-qty').html(total_qty);
        // console.log(item_total_val);
        //add to order table
        var tr_ = '<tr id="order-item-'+item_id+'"><td><input type="text" name="name[]" value="'+item_name+'"></td><td><input type="text" name="qty[]" value="'+item_qty_val+'"></td><td><input type="text" name="total[]" value="'+item_total_val+'"></td><td><span><input type="text" name="type[]" value="'+item_type+'"></span><input type="hidden"  value="'+item_qty_val+'" /></td></tr>';

        if($("#order-item-" + item_id).length)
        {
          //replace existing
          $('#order-item-'+item_id).replaceWith(tr_);

          //if qty 0 remove 
          if(item_qty_val == 0)
            $("#order-item-" + item_id).remove();
        }
        else
        {
          //append to parent
          $('#order-table > tbody').append(tr_);
          // console.log(tr_);
        }
    }