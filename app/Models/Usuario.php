<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'endereco', 'senha'];
    protected $hidden = ['senha'];

    public function contatos()
    {
        return $this->belongsToMany(Contato::class);
    }

    /**
     * Cria a conta de novo usuário.
     * 
     * @param string nome
     * @param string endereco
     * @param string senha
     * @param string repetirSenha
     * 
     * @return Usuario
     */
    public static function criarConta($nome, $endereco, $senha,
            $repetirSenha)
    {
        if ($senha == $repetirSenha)
        {
            $u = new Usuario([
                'nome' => $nome,
                'endereco' => $endereco,
                'senha' => $senha
            ]);
            $u->save();
            return $u;
        }
        return null;
    }

    public static function logar($nome, $senha)
    {
        // ...
    }

    public function excluirConta()
    {
        $this->contatos()->detach();
        $this->delete();
    }

    public function deslogar()
    {
        // ...
    }

    public function adicionarContato($c)
    {
        $c->save();
        $this->contatos()->attach($c->id);
    }

    public function listarContatos()
    {
        return $this->contatos()->orderBy('nome')->get();
    }

    public function buscar($termo)
    {
        return $this->contatos()->where('nome', 'like', "%$termo%")->get();
    }
}
