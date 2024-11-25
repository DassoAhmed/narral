function return_row_with_data(item_id) {
  $("#item_search").addClass('ui-autocomplete-loader-center');
  var base_url = $("#base_url").val().trim();
  var rowcount = $("#hidden_rowcount").val();
  $.post(base_url + "booking/return_row_with_data/" + rowcount + "/" + item_id, {}, function (result) {
    //alert(result);
    $('#booking_table tbody').append(result);
    $("#hidden_rowcount").val(parseFloat(rowcount) + 1);
    success.currentTime = 0;
    success.play();
    enable_or_disable_item_discount();
    $("#item_search").removeClass('ui-autocomplete-loader-center');
  });
}
