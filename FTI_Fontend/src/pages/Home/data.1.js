const data = {
    head: [

        {
            type: 'MainSlider',

        },
        {
            type: 'Title',
            data: {

                title: 'Njoftime '
            }
        },

    ],
    body: [{ type: "Card", },
        {
            type: "EffectButton",
            data: {
                title: "Me teper njoftime",
                link: "/njoftime",
            }
        },
        {
            type: "NewsContainer",
            data: [{
                    page: "Fakulteti",
                    element: "",
                    imgSrc: "https://content3.jdmagicbox.com/comp/tirupati/v8/9999px877.x877.150511162408.u1v8/catalogue/n-square-educational-consultancy-air-bypass-road-tirupati-education-consultants-6auqjk19w5.jpg?clr=5f0712",
                    text: "Rreth Fti",
                    rounded: true,
                },
                {
                    page: "Bachelor",
                    element: "",
                    imgSrc: "https://images.unsplash.com/photo-1591799265444-d66432b91588?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80",
                    text: "Bachelor",
                    rounded: true,
                },
                {
                    page: "Master",
                    element: "",
                    imgSrc: "https://images.unsplash.com/photo-1493119508027-2b584f234d6c?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80",
                    text: "Master",
                    rounded: true,
                },
            ],
        },
        {
            type: 'ImageComponent',
            data: {
                src: '6663.jpg'
            }

        },
        {
            type: 'EffectButton',
            data: {
                title: 'Kerkimi Shkencor',
                link: '/kerkimishkencor',

            }
        },
        {
            type: 'ImageComponent',
            data: {
                src: '30795.jpg'
            }

        },
        {
            type: 'EffectButton',
            data: {
                title: 'Eksperienca ne FTI',
                link: '/jetastudentore',

            }
        }

    ]
}

export default data;