<?php declare(strict_types=1);

namespace MLL\GraphiQL;

use Illuminate\Config\Repository;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;

class GraphiQLController
{
    public function __invoke(Request $request, Repository $config): View
    {
        $routePrefix = $config->get('graphql.graphiql.prefix', 'graphiql');
        $schemaName = $this->findSchemaNameInRequest($request, "/$routePrefix");

        $graphqlPath = '/' . $config->get('graphql.route.prefix', 'graphql');

        if ($schemaName) {
            $graphqlPath .= '/' . $schemaName;
        }
        $graphqlPath = '/' . trim($graphqlPath, '/');
        return view('graphiql::graphiql', [
            'graphqlPath' => $graphqlPath,
            'schema' => $schemaName,
        ]);
    }
    protected function findSchemaNameInRequest(Request $request, string $routePrefix): ?string
    {
        $path = $request->getPathInfo();

        if (!Str::startsWith($path, $routePrefix)) {
            return null;
        }

        return trim(Str::after($path, $routePrefix), '/');
    }

    // public function __invoke()
    // {
    //     return view('graphiql::index');
    // }
}
