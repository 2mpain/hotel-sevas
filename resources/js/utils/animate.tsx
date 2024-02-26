export const animate = (x: number, y: number) => {
    return {
      hidden: {
        x: x,
        y: y,
        opacity: 0,
      },
      visible: (custom: number) => ({
        x: 0,
        y: 0,
        opacity: 1,
        transition: { delay: custom * 0.2 },
      }),
    };
  };