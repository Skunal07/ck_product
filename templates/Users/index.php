<div class="users index content">
    <h3 class="text_center"><?= __('Users List') ?></h3>
    <div class="table-responsive" style="overflow: hidden;">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="dropdown">
                    <?= $this->Form->select(
                        'status',
                        [
                            'null' => 'All Users',
                            '1' => 'Active Users',
                            '2' => 'Inactive Users',
                        ],
                        ['id' => 'statusai', 'class' => 'btn btn-success active'],
                    );
                    ?>
                </div>
                <div class="myapp">
                    <?= $this->element('flash/user_index'); ?>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</div>
</div>
<?= $this->Html->css('index', ['block' => 'css']); ?>

<script>
    $(document).ready(function() {

        $('#statusai').change(function() {
            // alert('dd0');
            var status = $(this).val();
            // alert(status);
            // return false;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken // this is defined in app.php as a js variable
                }
            });
            // e.preventDefault();
            $.ajax({
                url: "http://localhost:8765/index",
                type: "JSON",
                method: "GET",
                data: {
                    'stat': status,
                },
                success: function(response) {
                    // alert(response);
                    $('.myapp').html('');
                    $('.myapp').append(response);
                }
            });
        });

        $('body').on('click', '.inac', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken // this is defined in app.php as a js variable
                }
            });
            var status = $(this).val();
            if (status == 1) {
                $(this).val('2');
            } else {
                $(this).val('1');
            }
            var id = $(this).prev('input').val();
            $.ajax({
                url: "http://localhost:8765/users/userstatus",
                type: "JSON",
                method: "POST",
                data: {
                    'id': id,
                    'status': status,
                },
                success: function(response) {
                    // alert(response)
                }
            });
        });
        // $('.active').click(function(e){
        //     var status = 1;
        //     // alert(status)
        //     e.preventDefault();
        //     $.ajax({
        //         url:'/index',
        //         type:'JSON',
        //         method:'get',
        //         data:{
        //             'stat':status,
        //         },
        //         success:function(response){
        //            $('.tablebody').html(response);
        //         }
        //     });
        // });
        $('.inactive').click(function(e) {
            var status = 2;
            e.preventDefault();
            $.ajax({
                url: '/index',
                type: 'JSON',
                method: 'get',
                data: {
                    'stat': status,
                },
                success: function(response) {
                    $('.tablebody').html(response);
                    // var data = JSON.parse(response)
                    // console.log(response)

                }
            });
        });
    })
</script>