@extends('intranet')

@section('content')
    <template v-if="menu==0">
        <dashboard></dashboard>
    </template>

    <template v-if="menu==1">
        <invitado></invitado>
    </template>

    <template v-if="menu==2">
        <individual></individual>
    </template>

    <template v-if="menu==3">
        <duplas></duplas>
    </template>

    <template v-if="menu==4">
        <trios></trios>
    </template>

    <template v-if="menu==5">
        <pendiente></pendiente>
    </template>

    <template v-if="menu==6">
        <todos></todos>
    </template>

    <template v-if="menu==7">
        <categoria></categoria>
    </template>

    <template v-if="menu==8">
        <polera></polera>
    </template>

    <template v-if="menu==9">
        <venta></venta>
    </template>
@endsection