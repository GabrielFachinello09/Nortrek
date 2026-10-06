CREATE TABLE carrinho (
    id            SERIAL PRIMARY KEY,
    cliente_id    INTEGER NOT NULL REFERENCES clientes(id) ON DELETE CASCADE,
    produto_id    INTEGER NOT NULL REFERENCES produtos(id) ON DELETE CASCADE,
    quantidade    INTEGER NOT NULL DEFAULT 1 CHECK (quantidade > 0),
    adicionado_em TIMESTAMP NOT NULL DEFAULT NOW(),
    UNIQUE (cliente_id, produto_id)
);

