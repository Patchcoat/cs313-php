CREATE TABLE polls(
    ID                  SERIAL          PRIMARY KEY,
    creation_date       DATE            NOT NULL DEFAULT CURRENT_DATE,
    url                 VARCHAR(20)     NOT NULL);

CREATE TABLE candidates(
    ID                  SERIAL          PRIMARY KEY,
    candidate           VARCHAR(50)     NOT NULL,
    rank                INTEGER         NOT NULL,
    poll_id             INTEGER         REFERENCES polls(id) NOT NULL);

CREATE TABLE votes(
    block_id            INTEGER         NOT NULL,
    poll_id             INTEGER         REFERENCES polls(id) NOT NULL,
    candidate_id        INTEGER         REFERENCES candidates(id) NOT NULL,
    rank                INTEGER         NOT NULL,
    IP                  CIDR            NOT NULL,
    PRIMARY KEY (block_id, rank));
