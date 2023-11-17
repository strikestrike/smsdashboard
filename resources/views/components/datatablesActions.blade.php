{{--@can($viewGate)--}}
@if(isset($viewGate))
<a class="btn btn-xs btn-primary" href="{{ route('admin.' . $crudRoutePart . '.show', $row->id) }}">
    {{ __('global.view') }}
</a>
@endif
{{--@endcan--}}
{{--@can($editGate)--}}
@if(isset($editGate))
<a class="btn btn-xs btn-info" href="{{ route('admin.' . $crudRoutePart . '.edit', $row->id) }}">
    {{ __('global.edit') }}
</a>
@endif
{{--@endcan--}}
{{--@can($deleteGate)--}}
@if(isset($deleteGate))
<form action="{{ route('admin.' . $crudRoutePart . '.destroy', $row->id) }}" method="POST" onsubmit="return confirm('{{ __('global.areYouSure') }}');" style="display: inline-block;">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="submit" class="btn btn-xs btn-danger" value="{{ __('global.delete') }}">
</form>
@endif
{{--@endcan--}}
