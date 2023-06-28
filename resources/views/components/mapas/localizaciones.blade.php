@extends('layouts.main')

@push('head-link')
<link rel="stylesheet" href="{{ asset('css/map.css') }}">
{{-- <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script> --}}
@endpush

@push('body-link')
<script type="module" src="{{ asset('js/mapLocalization.js') }}"></script>
<script>(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
        ({key: "", v: "weekly"});</script>
@endpush

@section('title', 'GPS APP | Rastreo')

@section('content')
{{-- CARD CON TABLA PARA MOSTRAR LOS VEHICULOS --}}
<div class="card" style="max-width: 1100px;">
  <h2 class="card-header card-title">Localizacion</h2>

  <div class="card-body">
    <div id="map"></div>
  </div>
</div>
@endsection

{{-- Añadir footer --}}