@props(["product", "index"])
<div class="pro-detail block justify-center order-last lg:order-none  max-lg:mx-auto">
    <h2 class="mb-2 font-manrope font-bold text-4xl mt-8 leading-10 text-gray-900 uppercase">
        {{ $product->name }}
    </h2>
    <h3 class="mb-2 font-manrope font-semibold text-2xl mt-6 leading-10 text-sky-600">
        {{ $product->brand->name }}
    </h3>
    <p class="text-gray-500 text-xl font-normal  mb-8 max-w-[40rem] break-words whitespace-pre-line overflow-hidden">
        {{ $product->description }}
    </p>

    <div class="flex flex-row w-full gap-6 mt-4">
        <a href="https://api.whatsapp.com/send?phone=5567099766" target="_blank" class="flex flex-row justify-center items-center content-center rounded-full h-10 px-6 bg-[#25D366] hover:bg-[#3da362] active:bg-[#25D366]  gap-4">
            <i class="bi bi-whatsapp text-xl text-white"></i>
            <p class="text-lg font-bold text-white">Whatsapp</p>
        </a>

        <a href="/contact" class="flex flex-row justify-center items-center content-center rounded-full h-10 px-6 bg-blue-700 hover:bg-blue-900 active:bg-blue-700  gap-4">
            <i class="bi bi-headset text-xl text-white"></i>
            <p class="text-lg font-bold text-white">Contactanos</p>
        </a>
    </div>
    @if ($product->has_table == 1)
    @php
        // Decodifica el JSON a array asociativo
        $tableData = json_decode($product->table_data, true);
        $headers   = $tableData['headers'] ?? [];
        $rows      = $tableData['table']   ?? [];
        echo "<script>console.log(". json_encode($rows) .");</script>";
    @endphp
        @if ($rows != [] && $headers != [])
            <div class="block w-full mt-8">
                <div class="text">
                    <div class="block w-full mb-6">
                        <p class="font-medium text-2xl leading-8 text-gray-900 mb-4">Modelos</p>
                        <div class="w-full overflow-auto">

                            <div class="w-full overflow-auto ">
                                {{-- <table class="min-w-full  border border-white  shadow-sm overflow-hidden border-separate" style="border-spacing: 0 0.1rem;">
                                    <thead>
                                        <tr>
                                            @foreach ($headers as $header)
                                                @if ($header != 'imagen')
                                                    <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider first:rounded-tl-lg last:rounded-tr-lg bg-[#4180ab] ">
                                                        {{ $header }}
                                                    </th>
                                                @endif
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach ($rows as $row)
                                            @if (isset($row['position']))
                                                <tr class="cursor-pointer group" data-position="{{ $row['position'] }}" onclick="changeCarouselImage('carousel-{{ $index }}', {{ $row['position'] }})">
                                                    @foreach ($headers as $header)
                                                        @if ($header != 'imagen' && $header != 'pdf'  && isset($row[$header]))
                                                            <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-900  bg-[#e4ebf0] group-hover:bg-[#bdd1de] transition transition-300">
                                                                {{ isset($row[$header])? $row[$header]: 'N/A' }}
                                                            </td>
                                                        @elseif ($header === 'pdf')
                                                            <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-900  bg-[#e4ebf0] group-hover:bg-[#bdd1de] transition transition-300">
                                                                <a href="/storage/{{$row[$header]}}">
                                                                    <i class="bi bi-file-earmark-pdf-fill   text-red-500"></i>
                                                                </a>
                                                            </td>
                                                        @endif
                                                    @endforeach
                                                </tr>
                                            @else
                                                <tr class="cursor-pointer group">
                                                    @foreach ($headers as $header)
                                                        @if ($header != 'imagen' && $header != 'pdf' )
                                                            <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-900  bg-[#e4ebf0] group-hover:bg-[#bdd1de] transition transition-300">
                                                                @if (isset($row[$header]))
                                                                    {{$row[$header]}}
                                                                @else
                                                                    {{ 'N/A' }}
                                                                @endif
                                                            </td>
                                                        @elseif ($header === 'pdf')
                                                            <td class="px-6 py-2 whitespace-nowrap text-sm text-gray-900  bg-[#e4ebf0] group-hover:bg-[#bdd1de] transition transition-300">
                                                                @if ($row[$header])
                                                                    <a href="/storage/{{$row[$header]}}">
                                                                        <i class="bi bi-file-earmark-pdf-fill   text-red-500"></i>
                                                                    </a>
                                                                @else
                                                                    {{ 'N/A' }}
                                                                @endif
                                                            </td>
                                                        @endif
                                                    @endforeach
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table> --}}

                                <table class=" w-full max-w-[40rem] border border-white shadow-sm overflow-auto border-separate" style="border-spacing: 0 0.1rem;">
                                    <thead>
                                        <tr>
                                            @foreach ($headers as $header)
                                                @if ($header != 'imagen')
                                                    <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider first:rounded-tl-lg last:rounded-tr-lg bg-[#4180ab]">
                                                        {{ $header }}
                                                    </th>
                                                @endif
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach ($rows as $rowindex => $row)
                                            @if (isset($row['position']))
                                                <tr class="cursor-pointer group" data-position="{{ $row['position'] }}" onclick="changeCarouselImage('carousel-{{ $index }}', {{ $row['position'] }})">
                                                    @foreach ($headers as $header)
                                                        @if ($header != 'imagen' && $header != 'pdf' && isset($row[$header]))
                                                            <td class="px-6 py-2 whitespace-nowrap text-xs text-gray-900 
                                                                @if($loop->parent->last) first:rounded-bl-lg last:rounded-br-lg @endif
                                                                @if($rowindex % 2 === 0) bg-[#d4e0e9] @else bg-[#e4ebf0] @endif
                                                                group-hover:bg-[#bdd1de] transition transition-300">
                                                                {{ $row[$header] ?? 'N/A' }}
                                                            </td>
                                                        @elseif ($header === 'pdf')
                                                            <td class="px-6 py-2 whitespace-nowrap text-xs text-gray-900 
                                                                @if($loop->parent->last) first:rounded-bl-lg last:rounded-br-lg @endif
                                                                @if($rowindex % 2 === 0) bg-[#d4e0e9] @else bg-[#e4ebf0] @endif
                                                                group-hover:bg-[#bdd1de] transition transition-300">
                                                                <a href="/storage/{{$row[$header]}}" target="_blank">
                                                                    <i class="bi bi-file-earmark-pdf-fill text-red-500"></i>
                                                                </a>
                                                            </td>
                                                        @endif
                                                    @endforeach
                                                </tr>
                                            @else
                                                <tr class="cursor-pointer group">
                                                    @foreach ($headers as $header)
                                                        @if ($header != 'imagen' && $header != 'pdf')
                                                            <td class="px-6 py-2 whitespace-nowrap text-xs text-gray-900 
                                                                @if($loop->parent->last) first:rounded-bl-lg last:rounded-br-lg @endif
                                                                @if($rowindex % 2 === 0) bg-[#d4e0e9] @else bg-[#e4ebf0] @endif
                                                                group-hover:bg-[#bdd1de] transition transition-300">
                                                                @if (isset($row[$header]))
                                                                    {{$row[$header]}}
                                                                @else
                                                                    {{ 'N/A' }}
                                                                @endif
                                                            </td>
                                                        @elseif ($header === 'pdf')
                                                            <td class="px-6 py-2 whitespace-nowrap text-xs text-gray-900 
                                                                @if($loop->parent->last) first:rounded-bl-lg last:rounded-br-lg @endif
                                                                @if($rowindex % 2 === 0) bg-[#d4e0e9] @else bg-[#e4ebf0] @endif
                                                                group-hover:bg-[#bdd1de] transition transition-300">
                                                                @if ($row[$header])
                                                                    <a href="/storage/{{$row[$header]}}" target="_blank">
                                                                        <i class="bi bi-file-earmark-pdf-fill text-red-500"></i>
                                                                    </a>
                                                                @else
                                                                    {{ 'N/A' }}
                                                                @endif
                                                            </td>
                                                        @endif
                                                    @endforeach
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    @endif
</div>