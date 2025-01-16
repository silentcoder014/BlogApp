@props(['title' => $globalConfigs->site_title ?? 'Default Title', 'article' => null])
<x-frontend.header :title="$title" :article="$article"/>

{{$slot}}

<x-frontend.footer/>
