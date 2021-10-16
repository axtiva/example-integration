CREATE TABLE transaction_table
(
    id         VARCHAR(1000)                  NOT NULL,
    amount     VARCHAR(1000)                  NOT NULL,
    status_id  VARCHAR(1000)                  NOT NULL,
    account_id VARCHAR(1000)                  NOT NULL,
    log        VARCHAR(1000) DEFAULT NULL,
    created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE account
(
    id             UUID                           NOT NULL,
    coded_currency INT          DEFAULT NULL,
    named_currency VARCHAR(255) DEFAULT NULL,
    number         VARCHAR(255)                   NOT NULL,
    amount         INT                            NOT NULL,
    created_at     TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL,
    status         INT                            NOT NULL,
    PRIMARY KEY (id)
);

CREATE INDEX IDX_7D3656A47BC0CCA8 ON account (coded_currency);
CREATE INDEX IDX_7D3656A4AB758AD2 ON account (named_currency);

COMMENT ON COLUMN account.id IS '(DC2Type:uuid)';
COMMENT ON COLUMN account.created_at IS '(DC2Type:datetime_immutable)';

CREATE TABLE coded_currency
(
    code INT NOT NULL,
    PRIMARY KEY (code)
);

CREATE TABLE named_currency
(
    name VARCHAR(255) NOT NULL,
    PRIMARY KEY (name)
);

ALTER TABLE account
    ADD CONSTRAINT FK_7D3656A47BC0CCA8 FOREIGN KEY (coded_currency) REFERENCES coded_currency (code) NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE account
    ADD CONSTRAINT FK_7D3656A4AB758AD2 FOREIGN KEY (named_currency) REFERENCES named_currency (name) NOT DEFERRABLE INITIALLY IMMEDIATE;
