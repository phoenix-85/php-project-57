<div>
    {{ html()->label('Имя', 'name') }}
    {{ html()->text('name') }}
</div>

<div>
    {{ html()->label('Имя', 'description') }}
    {{ html()->textarea('description') }}
</div>

<div>
    {{ html()->submit($action) }}
</div>




