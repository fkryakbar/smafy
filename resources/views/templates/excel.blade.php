<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>test</title>
    <style type="text/css">
        body {
            font-family: sans-serif;
        }

        table {
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #3c3c3c;
            padding: 3px 8px;

        }

        a {
            background: blue;
            color: #fff;
            padding: 8px 10px;
            text-decoration: none;
            border-radius: 2px;
        }
    </style>
</head>
@php
    $soal_id = [];
    $score_total = 0;
@endphp

<body>
    <table>
        <tr>
            <td>Topik</td>
            <td>{{ $package->title }}</td>
        </tr>
        <tr>
            <td>Tipe Topik</td>
            <td style="text-transform: uppercase">{{ $package->topic_type }}</td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Kelas</th>
            @foreach ($soal as $s)
                <th>{{ $s->title }}</th>
                @php
                    array_push($soal_id, $s->id);
                @endphp
            @endforeach
            <th>Skor</th>
            <th>Sisa waktu (Detik)</th>
        </tr>
        @foreach ($siswa_data as $i => $item)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->kelas }}</td>
                @for ($i = 0; $i < count($soal_id); $i++)
                    @if (isset($item->get_answer[$i]->answer))
                        @if ($item->get_answer[$i]->result == 1)
                            <td>{{ $item->get_answer[$i]->answer }}</td>
                        @else
                            <td style="background-color: red; color:white ">{{ $item->get_answer[$i]->answer }}</td>
                        @endif
                    @else
                        <td style="background-color: red; color:white ">0</td>
                    @endif
                    {{-- <td>0</td> --}}
                @endfor

                <td>{{ $item->score }}</td>
                @php
                    $score_total = $score_total + $item->score;
                @endphp
                <td>{{ $item->time_left }}</td>
            </tr>
        @endforeach
    </table>
    <br>
    <table>
        <tr>
            <td>Rata-rata</td>
            <td>{{ round($score_total / count($siswa_data), 2) }}</td>
        </tr>
    </table>
</body>

</html>
