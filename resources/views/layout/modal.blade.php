<div class="modal fade" id="notifications" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">通知</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul>
                    @forelse ($notifications as $notification)
                        <li class="read_notification" data-id="{{$notification->id}}">
                            {{$notification->data['msg']}}
                            <span class="read">
                                @if($notification->read_at)
                                    (已讀)
                                @endif
                            </span>
                        </li>
                    @empty
                        <p>(無通知)</p>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('click', '.read_notification', function () {
        var $this = $(this);
        $.ajax({
            method: 'post',
            url: '/read-notification',
            data: {
                id: $this.data('id')
            },
            headers: {
                "Authorization": "Bearer " + "{{\Illuminate\Support\Facades\Session::get('access_token')}}",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        }).done(function (msg) {
            if (msg.result) {
                $this.find('.read').text('(已讀)');
            }
        })
    })
</script>
