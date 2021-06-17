<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 text-center">
            <svg id="wheel">
                <defs>
                    <filter id="shadow"  x="0" y="0" width="200%" height="200%">
                        <feDropShadow
                            dx="5"
                            dy="5"
                            stdDeviation="3"
                            floodColor="#9e9e9e"
                            floodOpacity="0.25"
                        />
                    </filter>
                </defs>
            </svg>
        </div>
    </div>
</div>

@push('header')
    <style>
        .path {
            fill: none;
            stroke: #56c2a3;
            stroke-opacity: 0.4;
            stroke-width: 1.5;
        }
        .label {
            text-shadow:
                -1px -1px 3px white,
                -1px  1px 3px white,
                1px -1px 3px white,
                1px  1px 3px white;
            pointer-events: none;
            font-family: 'Playfair Display', serif;
            font-size: 12px;
        }
        .node {
            cursor: pointer;
            filter: url(#shadow);
        }
        .node:hover {
            filter: none;
        }
        path.highlight {
            stroke: #f4511e;
            stroke-opacity: 1;
            stroke-width: 4;
            stroke-dasharray: 4px;
            stroke-dashoffset: 8px;
            animation: stroke 0.2s linear infinite;
        }

        @keyframes stroke {
            to {
                stroke-dashoffset: 0;
            }
        }

    </style>
@endpush

@push('footer')
    <script src="{{ asset('wheel/olfaction.js') }}"></script>
    <script>
        $(document).ready(function() {
            d3.json("{{ asset('wheel/olfaction.json') }}")
                .then((data) => {
                    loadWheel(data)
                })
                .catch((error) => {
                    console.log(error)
                })
        })
    </script>
@endpush
