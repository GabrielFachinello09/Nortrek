--
-- PostgreSQL database dump
--

\restrict 7CAYNZI6wcQtrk0g9Bh4TY6iuwTJMT13rgxeiRmV7zcQcIYpkDfpeBwqZlhVGoH

-- Dumped from database version 18.6 (Ubuntu 18.6-0ubuntu0.26.04.1)
-- Dumped by pg_dump version 18.6 (Ubuntu 18.6-0ubuntu0.26.04.1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: alunos; Type: TABLE; Schema: public; Owner: escola
--

CREATE TABLE public.alunos (
    id integer NOT NULL,
    nome character varying(60) NOT NULL,
    nasc date,
    turma text,
    ativo boolean
);


ALTER TABLE public.alunos OWNER TO escola;

--
-- Name: alunos_id_seq; Type: SEQUENCE; Schema: public; Owner: escola
--

CREATE SEQUENCE public.alunos_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.alunos_id_seq OWNER TO escola;

--
-- Name: alunos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: escola
--

ALTER SEQUENCE public.alunos_id_seq OWNED BY public.alunos.id;


--
-- Name: usuario; Type: TABLE; Schema: public; Owner: escola
--

CREATE TABLE public.usuario (
    id integer NOT NULL,
    email character varying(60) NOT NULL,
    senha character varying(12) NOT NULL
);


ALTER TABLE public.usuario OWNER TO escola;

--
-- Name: usuario_id_seq; Type: SEQUENCE; Schema: public; Owner: escola
--

CREATE SEQUENCE public.usuario_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.usuario_id_seq OWNER TO escola;

--
-- Name: usuario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: escola
--

ALTER SEQUENCE public.usuario_id_seq OWNED BY public.usuario.id;


--
-- Name: usuarios; Type: TABLE; Schema: public; Owner: escola
--

CREATE TABLE public.usuarios (
    id integer NOT NULL,
    email character varying(60) NOT NULL,
    senha character varying(12) NOT NULL
);


ALTER TABLE public.usuarios OWNER TO escola;

--
-- Name: usuarios_id_seq; Type: SEQUENCE; Schema: public; Owner: escola
--

CREATE SEQUENCE public.usuarios_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.usuarios_id_seq OWNER TO escola;

--
-- Name: usuarios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: escola
--

ALTER SEQUENCE public.usuarios_id_seq OWNED BY public.usuarios.id;


--
-- Name: alunos id; Type: DEFAULT; Schema: public; Owner: escola
--

ALTER TABLE ONLY public.alunos ALTER COLUMN id SET DEFAULT nextval('public.alunos_id_seq'::regclass);


--
-- Name: usuario id; Type: DEFAULT; Schema: public; Owner: escola
--

ALTER TABLE ONLY public.usuario ALTER COLUMN id SET DEFAULT nextval('public.usuario_id_seq'::regclass);


--
-- Name: usuarios id; Type: DEFAULT; Schema: public; Owner: escola
--

ALTER TABLE ONLY public.usuarios ALTER COLUMN id SET DEFAULT nextval('public.usuarios_id_seq'::regclass);


--
-- Data for Name: alunos; Type: TABLE DATA; Schema: public; Owner: escola
--

COPY public.alunos (id, nome, nasc, turma, ativo) FROM stdin;
6	Teste	2026-09-08	Update	t
9	Gouvea	2026-09-09	I1D35	t
10	GabiGol	2026-09-25	I1D35	t
\.


--
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: escola
--

COPY public.usuario (id, email, senha) FROM stdin;
1	gabriel@gmail.com	1234
2	gabriel@gmail.com	1234
3	admin@admin.com.br	123
4		
\.


--
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: escola
--

COPY public.usuarios (id, email, senha) FROM stdin;
\.


--
-- Name: alunos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: escola
--

SELECT pg_catalog.setval('public.alunos_id_seq', 10, true);


--
-- Name: usuario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: escola
--

SELECT pg_catalog.setval('public.usuario_id_seq', 4, true);


--
-- Name: usuarios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: escola
--

SELECT pg_catalog.setval('public.usuarios_id_seq', 1, false);


--
-- Name: alunos alunos_pkey; Type: CONSTRAINT; Schema: public; Owner: escola
--

ALTER TABLE ONLY public.alunos
    ADD CONSTRAINT alunos_pkey PRIMARY KEY (id);


--
-- Name: usuario usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: escola
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (id);


--
-- Name: usuarios usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: escola
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id);


--
-- PostgreSQL database dump complete
--

\unrestrict 7CAYNZI6wcQtrk0g9Bh4TY6iuwTJMT13rgxeiRmV7zcQcIYpkDfpeBwqZlhVGoH

