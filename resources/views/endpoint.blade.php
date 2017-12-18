@php($firstMethod = strtoupper (array_first((array)$endpoint->methods)))
<div class="callout {{ array_get($methodMap, $firstMethod) }} }}">
    <p class="clearfix">
        @if($firstMethod == 'GET')
            <a href="/api/{{ $endpoint->uri }}" target="_blank"
               class="float-right">{!! $icons('external-link') !!}</a>
        @endif
        <code>/api/{!! preg_replace('#({[^}]+})#', '<span style="color:orange;">$1</span>', $endpoint->uri) !!}</code>
        @foreach((array)$endpoint->methods as $method)
            <span class="label {{ array_get($methodMap, strtoupper ($method)) }}">{{ strtoupper ($method) }}</span>
        @endforeach
    </p>
    <hr>
    @if ($endpoint->description)
        <div>
            <h6><u>Description:</u></h6>
            <p>{{ $endpoint->description }}</p>
        </div>
    @endif
    @if ($endpoint->parameters and is_array ($endpoint->parameters) and count($endpoint->parameters))
        <div>
            <h6><u>Parameters:</u></h6>
            <table>
                <tbody>
                @foreach ($endpoint->parameters as $parameter)
                    <tr>
                        <td><code>{{ $parameter[0] }}</code></td>
                        <td>{{ $parameter[1] or '' }}</td>
                        <td>{{ $parameter[2] or '' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
    @if ($endpoint->examples and is_array ($endpoint->examples) and count($endpoint->examples))
        <div>
            <h6><u>Examples:</u></h6>
            <table>
                <tbody>
                @foreach ($endpoint->examples as $example)
                    <tr>
                        <td>{{ $example[0] }}</td>
                        <td><code>{{ $example[1] }}</code></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>