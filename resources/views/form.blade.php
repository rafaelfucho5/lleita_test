@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<form method="POST" action="/send-sms">
    @csrf
    <div class="form-group">
        <label for="dest">Destinatario</label>
        <input type="text" class="form-control" id="dest" name="dest">
    </div>
    <div class="form-group">
        <label for="message">Mensaje</label>
        <textarea class="form-control" id="message" name="message"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Enviar SMS</button>
</form>
