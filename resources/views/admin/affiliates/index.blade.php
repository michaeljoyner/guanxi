@extends('admin.base')

@section('content')
    <section class="dd-page-header clearfix">
        <h1 class="pull-left">Guanxi Affiliates</h1>
        <div class="header-actions pull-right">
            <button type="button" class="btn dd-btn btn-dark" data-toggle="modal" data-target="#create-affiliate-modal">
                New Affiliate
            </button>
        </div>
    </section>
    <section class="affiliate-listing">
        <table class="table">
            <tbody>
            @foreach($affiliates as $affiliate)
                <tr>
                    <td><a href="/admin/affiliates/{{ $affiliate->id }}">{{ $affiliate->name }}</a></td>
                    <td>{{ $affiliate->getTranslation('location', 'en') }}</td>
                    <td>{{ $affiliate->published ? 'Published' : 'Unpublished' }}</td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </section>
    @include('admin.forms.modals.affiliate')
@endsection

@section('bodyscripts')

@endsection