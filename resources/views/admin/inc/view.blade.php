<script type="text/javascript">
function ajaxLoad(filename, content) {
content = typeof content !== 'undefined' ? content : 'content';
$('.loading').show();
$.ajax({
   type: "GET",
   url: filename,
   contentType: false,
   success: function (data) {
       $("#" + content).html(data);
       $('.loading').hide();
   },
   error: function (xhr, status, error) {
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