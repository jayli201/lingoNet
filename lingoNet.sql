#https://docs.google.com/document/d/1GZ4WgQWfCFTaxYcrASyTh2MDAzgmvOl_biB4CWu-yZw/edit?usp=sharing 

# User(email NOT NULL, password NOT NULL, name NOT NULL, age NOT NULL, phone NOT NULL)
# Target(email, target)
# Native(email, native)
# Post(email, introduction NOT NULL, lookingFor NOT NULL, whyYou NOT NULL)
# Friend(email, friendEmail) 
# Pending(email, friendEmail)

# ---------------------------------- CREATING ALL TABLES ----------------------------------

# ---------------------------------- users ----------------------------------

CREATE TABLE IF NOT EXISTS users (
    email varchar(40),
    password varchar(40) NOT NULL,
    firstName varchar(40) NOT NULL,
    lastName varchar(40) NOT NULL,
    age int NOT NULL,
    phone varchar(40) NOT NULL, 
    primary key(email)
);

# ---------------------------------- target ----------------------------------

CREATE TABLE IF NOT EXISTS target (
    email varchar(40), 
    target varchar(40),
    primary key(email, target)
);

# ---------------------------------- native ----------------------------------

CREATE TABLE IF NOT EXISTS native (
    email varchar(40), 
    native varchar(40),
    primary key(email, native)
);

# ---------------------------------- post ----------------------------------

CREATE TABLE IF NOT EXISTS post(
    email varchar(40),
    introduction text NOT NULL,
    lookingFor text NOT NULL,
    whyYou text NOT NULL,
    primary key(email)
);

# ---------------------------------- friend ----------------------------------

CREATE TABLE IF NOT EXISTS friend (
    email varchar(40), 
    friendEmail varchar(40), 
    primary key(email, friendEmail)
);

# ---------------------------------- pending ----------------------------------

CREATE TABLE IF NOT EXISTS pending (
    email varchar(40), 
    friendEmail varchar(40), 
    primary key(email, friendEmail)
);
