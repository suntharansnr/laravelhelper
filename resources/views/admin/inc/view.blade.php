<script type="text/javascript">
function ajaxLoad(filename, content) {
content = typeof content !== 'undefined' ? content : 'content';
$('.loading').show();
$.ajax({
   type: "GET",
   url: filename,
   contentType: false,
   success: function (data) {
       $('.loading').hide();
       $("#" + content).html(data);
   },
   error: function (xhr, status, error) {
       $('.loading').hide();
       alert(xhr.responseText);
   }
});
}
</script>
<script type="text/javascript">
    $('#modalForm').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    ajaxLoad(button.data('href'),'modal_contentRaj');
    });

    $('#modalForm').on('shown.bs.modal', function () {
      $('#focus').trigger('focus')
    });
</script>