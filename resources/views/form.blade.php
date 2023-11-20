<div>
    <form action="/form/csrf" method="post">
        <input type="text" name="name">

        <input type="hidden" name="_token" value={{csrf_token()}}>
        <button type="submit">Send</button>
    </form>
</div>
