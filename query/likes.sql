--
-- PostgreSQL database dump
--

-- Dumped from database version 9.4.14
-- Dumped by pg_dump version 9.4.14
-- Started on 2018-10-23 14:55:00

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 177 (class 1259 OID 17199)
-- Name: likes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE likes (
    id integer NOT NULL,
    user_id integer NOT NULL,
    movie_id integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE likes OWNER TO postgres;

--
-- TOC entry 176 (class 1259 OID 17197)
-- Name: likes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE likes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE likes_id_seq OWNER TO postgres;

--
-- TOC entry 2037 (class 0 OID 0)
-- Dependencies: 176
-- Name: likes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE likes_id_seq OWNED BY likes.id;


--
-- TOC entry 1917 (class 2604 OID 17202)
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY likes ALTER COLUMN id SET DEFAULT nextval('likes_id_seq'::regclass);


--
-- TOC entry 2032 (class 0 OID 17199)
-- Dependencies: 177
-- Data for Name: likes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY likes (id, user_id, movie_id, created_at, updated_at) FROM stdin;
119	45	5	\N	\N
120	45	38	\N	\N
121	26	7	\N	\N
128	26	3	\N	\N
130	26	39	\N	\N
21	25	35	\N	\N
22	25	38	\N	\N
23	25	7	\N	\N
24	25	5	\N	\N
42	40	39	\N	\N
44	40	5	\N	\N
45	40	2	\N	\N
46	40	36	\N	\N
47	41	6	\N	\N
48	41	7	\N	\N
49	41	2	\N	\N
50	41	39	\N	\N
51	41	36	\N	\N
52	41	41	\N	\N
53	41	13	\N	\N
54	41	10	\N	\N
55	26	5	\N	\N
56	25	4	\N	\N
57	25	40	\N	\N
58	42	36	\N	\N
59	42	4	\N	\N
60	42	35	\N	\N
61	42	40	\N	\N
62	42	41	\N	\N
63	42	37	\N	\N
64	42	10	\N	\N
66	42	11	\N	\N
71	44	38	\N	\N
72	44	11	\N	\N
76	42	12	\N	\N
77	42	9	\N	\N
85	42	2	\N	\N
87	42	38	\N	\N
88	42	5	\N	\N
91	42	39	\N	\N
92	42	7	\N	\N
94	42	3	\N	\N
\.


--
-- TOC entry 2038 (class 0 OID 0)
-- Dependencies: 176
-- Name: likes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('likes_id_seq', 136, true);


--
-- TOC entry 1919 (class 2606 OID 17204)
-- Name: likes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY likes
    ADD CONSTRAINT likes_pkey PRIMARY KEY (id);


--
-- TOC entry 1921 (class 2606 OID 17216)
-- Name: likes_user_id_movie_id_unique; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY likes
    ADD CONSTRAINT likes_user_id_movie_id_unique UNIQUE (user_id, movie_id);


-- Completed on 2018-10-23 14:55:00

--
-- PostgreSQL database dump complete
--

