<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset=utf-8/>
    <meta name="viewport"
          content="user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, minimal-ui">
    <title>GraphiQL</title>
    <script src="{{ \MLL\GraphiQL\DownloadAssetsCommand::reactPath() }}"></script>
    <script src="{{ \MLL\GraphiQL\DownloadAssetsCommand::reactDOMPath() }}"></script>
    <link rel="stylesheet" href="{{ \MLL\GraphiQL\DownloadAssetsCommand::cssPath() }}"/>
    <link rel="shortcut icon" href="{{ \MLL\GraphiQL\DownloadAssetsCommand::faviconPath() }}"/>
</head>

<body>

<div id="graphiql">Loading...</div>
<script src="{{ \MLL\GraphiQL\DownloadAssetsCommand::jsPath() }}"></script>
<script>
    async function graphQLFetcher(graphQLParams) {
        const response = await fetch('{{ url(config('graphiql.endpoint')) }}', {
            method: 'post',
            headers: {
                Accept: 'application/json',
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(graphQLParams),
            credentials: 'omit',
        });

        try {
            return await response.json();
        } catch {
            return await response.text();
        }
    }

    ReactDOM.render(
        React.createElement(GraphiQL, {
            fetcher: graphQLFetcher,
        }),
        document.getElementById('graphiql'),
    );
</script>

</body>
</html>
