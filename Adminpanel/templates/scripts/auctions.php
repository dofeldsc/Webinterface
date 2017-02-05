<script type="text/javascript">
    $(document).ready(function(){
        weaponList = $('#WeaponList').DataTable({
            "pageLength": 25,
            "responsive": false,
            "pagingType": "full_numbers",
            "columnDefs": [{
                "orderable": false,
                "targets": [-1,-2],
            }],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json"
            }
        });

        ClothingList = $('#ClothingList').DataTable({
            "pageLength": 25,
            "responsive": false,
            "pagingType": "full_numbers",
            "columnDefs": [{
                "orderable": false,
                "targets": [-1,-2],
            }],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json"
            }
        });

        ItemList = $('#ItemList').DataTable({
            "pageLength": 25,
            "responsive": false,
            "pagingType": "full_numbers",
            "columnDefs": [{
                "orderable": false,
                "targets": [-1,-2],
            }],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json"
            }
        });

        OtherList = $('#OtherList').DataTable({
            "pageLength": 25,
            "responsive": false,
            "pagingType": "full_numbers",
            "columnDefs": [{
                "orderable": false,
                "targets": [-1,-2],
            }],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json"
            }
        });
    });
</script>