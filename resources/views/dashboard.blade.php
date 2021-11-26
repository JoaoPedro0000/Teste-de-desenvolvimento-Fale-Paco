<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Conversor de Moedas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{url('/dashboard')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Valor</label>
                                    <input id="valor" name="valor" type="number" style="text-align: end;" class="form-control" value="0.00">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Converter de</label>
                                    <select class="form-control" style="text-align: center;" id="selectMoeda1" name="selectMoeda1">
                                        @foreach($responseArray['rates'] ?? '' as $moeda => $value)
                                            @if($moeda == "BRL")
                                                <option value="{{$moeda}}" selected>{{$moeda}}</option>
                                            @else
                                                <option value="{{$moeda}}">{{$moeda}}</option>
                                            @endif
                                        @endforeach  
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1" style="text-align: center; margin-top: 2.1%; margin-bottom: 2%;">
                                <button type="button" class="btn btn-dark" onclick="invert();">
                                    <x-button-revert />
                                </button>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Converter para</label>
                                    <select class="form-control" style="text-align: center;" id="selectMoeda2" name="selectMoeda2">
                                        @foreach($responseArray['rates'] ?? '' as $moeda => $value)
                                            @if($moeda == "USD")
                                                <option value="{{$moeda}}" selected>{{$moeda}}</option>
                                            @else
                                                <option value="{{$moeda}}">{{$moeda}}</option>
                                            @endif
                                        @endforeach 
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1" style="text-align: center; margin-top: 2.1%; margin-bottom: 2%;">
                                <button type="submit" class="btn btn-dark">Converter</button>
                            </div>
                        </div>
                    </form>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <h3 style="margin-top: 1%; margin-bottom: 1%;">Data da cotação: {{date("d-m-y", strtotime($responseArray['date']))}}</3>
                    </div>

                    <div class="d-grid gap-2 col-6 mx-auto">
                    <button class="btn btn-dark" style="cursor:default; margin-top: 2%; margin-bottom: 5%;" type="button">
                        Resultado: 
                        @if($valorConversao ?? '')
                            {{round($valorConversao,2)}} {{$selectMoeda2 ?? ''}}
                        @endif    
                    </button>
                    </div>

                    <table class="table table-striped table-hover" style="width:100%" id="tabela">
                        <thead>
                            <tr>
                            <th>ID</th>
                            <th>Valor</th>
                            <th>Converter de</th>
                            <th>Converter para</th>
                            <th>Resultado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($conversoes ?? '' as $chave => $val)
                                <tr>
                                    <td>{{$chave+1}}</td>
                                    <td>{{$val['valor']}}</td>
                                    <td>{{$val['moeda1']}}</td>
                                    <td>{{$val['moeda2']}}</td>
                                    <td>{{round($val['resultado'], 2)}} {{$val['moeda2']}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>