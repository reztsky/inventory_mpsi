@if (session('message'))
<div class="position-absolute top-0 end-0 pt-3 pe-2">
    <div class="toast show align-items-center border-1 bg-{{session('message.bg')}} text-white" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
            {{session('message.message')}}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>
@endif
