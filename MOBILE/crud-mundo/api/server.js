// server.js (CÓDIGO ATUALIZADO para a tabela PAISES)

const express = require('express');
const mysql = require('mysql');
const cors = require('cors');
const bodyParser = require('body-parser');

const app = express();
const port = 8081;

// 🚨 IMPORTANTE: Mude as credenciais e o nome do banco de dados (DATABASE)
const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'bd_mundo' // <-- NOME DO NOVO BANCO DE DADOS
});

// Conecta ao MySQL
db.connect(err => {
    if (err) {
        console.error('Erro ao conectar ao MySQL:', err.stack);
        return;
    }
    console.log('Conectado ao MySQL como id ' + db.threadId);
});

// Middleware
app.use(cors());
app.use(bodyParser.json());

// --- ROTAS DA API ---
app.get('/', (req, res) => {
    res.status(200).json({ 
        status: "OK", 
        message: "API de Países funcionando! Acesse /paises para os dados." 
    });
});
// Rota 1: Listar todos os países (GET /paises)
app.get('/paises', (req, res) => {
    const SQL = 'SELECT * FROM paises'; // <-- MUDANÇA: Tabela 'paises'
    db.query(SQL, (err, results) => {
        if (err) {
            console.error('Erro ao buscar países:', err);
            return res.status(500).send('Erro no servidor');
        }
        res.json(results);
    });
});

// Rota 2: Adicionar um novo país (POST /paises)
app.post('/paises', (req, res) => {
    // <-- MUDANÇA: Campos da tabela 'paises'
    const { nome, continente, populacao, idioma } = req.body;

    if (!nome || !continente || !populacao || !idioma) {
        return res.status(400).send('Todos os campos (nome, continente, populacao, idioma) são obrigatórios.');
    }

    const SQL = 'INSERT INTO paises (nome, continente, populacao, idioma) VALUES (?, ?, ?, ?)';
    
    // Mapeamento dos valores para a query
    db.query(SQL, [nome, continente, populacao, idioma], (err, result) => {
        if (err) {
            console.error('Erro ao inserir país:', err);
            return res.status(500).send('Erro no servidor');
        }
        // Retorna o objeto inserido com o ID gerado
        res.status(201).json({ id_pais: result.insertId, nome, continente, populacao, idioma }); 
    });
});
app.put('/paises/:id_pais', (req, res) => {
    const id = req.params.id_pais;
    const { nome, continente, populacao, idioma } = req.body;

    if (!nome || !continente || !populacao || !idioma) {
        return res.status(400).send('Todos os campos são obrigatórios para a atualização.');
    }

    const SQL = `UPDATE paises 
                 SET nome = ?, continente = ?, populacao = ?, idioma = ? 
                 WHERE id_pais = ?`;

    db.query(SQL, [nome, continente, populacao, idioma, id], (err, result) => {
        if (err) {
            console.error('Erro ao atualizar país:', err);
            return res.status(500).send('Erro no servidor ao atualizar.');
        }

        if (result.affectedRows === 0) {
            return res.status(404).send('País não encontrado.');
        }

        res.status(200).json({ id_pais: id, message: "País atualizado com sucesso!" });
    });
});


// Rota 4: Excluir um país (DELETE /paises/:id_pais)
app.delete('/paises/:id_pais', (req, res) => {
    const id = req.params.id_pais;

    const SQL = 'DELETE FROM paises WHERE id_pais = ?';

    db.query(SQL, [id], (err, result) => {
        if (err) {
            console.error('Erro ao excluir país:', err);
            return res.status(500).send('Erro no servidor ao excluir.');
        }

        if (result.affectedRows === 0) {
            return res.status(404).send('País não encontrado.');
        }

        res.status(200).json({ id_pais: id, message: "País excluído com sucesso!" });
    });
});
// Inicia o servidor
app.listen(port, () => {
    console.log(`Backend rodando em http://localhost:${port}`);
});