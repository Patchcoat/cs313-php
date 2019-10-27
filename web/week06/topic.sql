CREATE TABLE topic(
    id SERIAL PRIMARY KEY,
    name TEXT
);

INSERT INTO topic (name) VALUES ('Faith');
INSERT INTO topic (name) VALUES ('Sacrifice');
INSERT INTO topic (name) VALUES ('Charity');

CREATE TABLE scripture_topic(
    topic INT NOT NULL,
    scripture INT NOT NULL,
    PRIMARY KEY (topic, scripture),
    FOREIGN KEY (topic) REFERENCES topic(id),
    FOREIGN KEY (scripture) REFERENCES scriptures(id)
);
