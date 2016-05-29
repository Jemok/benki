<div style="padding-top: 5%;">
    <form class="form-horizontal" method="post" action="{{ route('sendRequest', [$account_id])}}">
        {{ csrf_field() }}

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">

                    <i class="fa fa-btn fa-sign-in"></i>Send Request
                </button>
            </div>
        </div>
    </form>
</div>