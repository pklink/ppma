<?php


namespace ppma\Action\Login;


use Firebase\JWT\JWT;
use ppma\Action\AbstractAction;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class IndexAction extends AbstractAction
{

    public function __invoke(Request $request, Response $response, array $args) : ResponseInterface
    {
        $username = $request->getParsedBodyParam('username');
        $password = $request->getParsedBodyParam('password');

        // are all needed params provided?
        if (in_array(null, [$username, $password])) {
            return $response->withStatus(403);
        }

        // get user from database
        $user = $this->db->table('users')->where('username', $username)->first();

        // user does not exist
        if ($user === null) {
            return $response->withStatus(403);
        }

        // check password
        if (!password_verify($password, $user->password)) {
            return $response->withStatus(403);
        }

        // payload for token
        $payload = [
            'iat'  => (new \DateTime())->getTimestamp(),
            'exp'  => (new \DateTime('now +5 minutes'))->getTimestamp(),
            'user' => [
                'id'       => $user->id,
                'username' => $user->username
            ]
        ];

        // create token
        $token = JWT::encode($payload, $this->settings['secret'], 'HS256');

        return $response
            ->withStatus(200)
            ->withJson(['token' => $token]);
    }

}
