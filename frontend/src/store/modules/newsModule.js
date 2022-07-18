export default {
    state: {
        news: [
            {
                id: 1,
                title: "Começa os treinos para a nova temporada",
                content: `Lorem ipsum dolor, sit amet consectetur adipisicing elit. Minus deserunt
                quibusdam iusto, dignissimos dolore officiis libero voluptates eum non
                velit veritatis maiores fugit nobis, magnam molestias in quod labore
                alias? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa
                aperiam soluta expedita molestiae neque doloribus ad deleniti libero
                cupiditate, iusto dolore. Expedita ad blanditiis officiis culpa
                quibusdam laudantium facere fuga?`,
                date: "2021-01-01",
                img: "news1.jpg",
                imgInfo: "Noticia 1",
            },
            {
                id: 2,
                title: "jogo de quarta-feira termina empatado",
                content: `Lorem ipsum dolor, sit amet consectetur adipisicing elit. Minus deserunt
                quibusdam iusto, dignissimos dolore officiis libero voluptates eum non
                velit veritatis maiores fugit nobis, magnam molestias in quod labore
                alias? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa
                aperiam soluta expedita molestiae neque doloribus ad deleniti libero
                cupiditate, iusto dolore. Expedita ad blanditiis officiis culpa
                quibusdam laudantium facere fuga?`,
                date: "2021-01-02",
                img: "news2.jpg",
                imgInfo: "Noticia 2",
            },
            {
                id: 3,
                title: "A inauguração do novo estadio sera na semana que vem",
                content: `Lorem ipsum dolor, sit amet consectetur adipisicing elit. Minus deserunt
                quibusdam iusto, dignissimos dolore officiis libero voluptates eum non
                velit veritatis maiores fugit nobis, magnam molestias in quod labore
                alias? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa
                aperiam soluta expedita molestiae neque doloribus ad deleniti libero
                cupiditate, iusto dolore. Expedita ad blanditiis officiis culpa
                quibusdam laudantium facere fuga?`,
                date: "2021-01-03",
                img: "news3.jpg",
                imgInfo: "Noticia 3",
            }
        ]
    },
    getters: {
        getNews(state){
            return state.news;
        },
        getNewsFromId: state => id => {
            let notice = state.news.find(item => {
                return (item.id == id)
            });

            return notice;
        }
    }
}