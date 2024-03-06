import * as React from "react";
import Box from "@mui/joy/Box";
import Drawer from "@mui/joy/Drawer";
import { Button } from "@/Components/readyToUse/button";
import List from "@mui/joy/List";
import Divider from "@mui/joy/Divider";
import ListItem from "@mui/joy/ListItem";
import ListItemButton from "@mui/joy/ListItemButton";
import { Menu } from "lucide-react";
import "../../../css/index.css";
import { useTheme } from "@/Components/readyToUse/theme-provider";

export default function DrawerComp() {
  const [open, setOpen] = React.useState(false);

  const { theme } = useTheme();

  const toggleDrawer =
    (inOpen: boolean) => (event: React.KeyboardEvent | React.MouseEvent) => {
      if (
        event.type === "keydown" &&
        ((event as React.KeyboardEvent).key === "Tab" ||
          (event as React.KeyboardEvent).key === "Shift")
      ) {
        return;
      }

      setOpen(inOpen);
    };

  const drawerItems = [
    {
      id: 1,
      text: "Вход",
      page: "signIn",
    },
    {
      id: 2,
      text: "Отзывы клиентов",
      page: "feedbacks",
    },
    {
      id: 3,
      text: "Ответы на вопросы",
      page: "questions",
    },
    {
      id: 4,
      text: "Как к нам заехать?",
      page: "steps",
    },
    {
      id: 5,
      text: "Наши номера",
      page: "rooms",
    },
    {
      id: 6,
      text: "Обратная связь",
      page: "contactus",
    },
  ];

  const handleMenuItemClick = (page: string) => {
    console.log(page);
    setOpen(false);
    const section = document.getElementById(page);
    if (section) {
      section.scrollIntoView({ behavior: "smooth" });
    }
  };

  return (
    <Box sx={{}}>
      <Button size="icon" className="my-2">
        <Menu
          className={`burger ${theme === "dark" ? "dark-burger" : ""}`}
          color={theme === "dark" ? "black" : "white"}
          onClick={toggleDrawer(true)}
        />
      </Button>

      <Drawer open={open} onClose={toggleDrawer(false)}>
        <Box
          role="presentation"
          onClick={toggleDrawer(false)}
          onKeyDown={toggleDrawer(false)}
        >
          <List>
            {drawerItems.slice(0, 4).map((item) => (
              <ListItem
                key={item.id}
                onClick={() => handleMenuItemClick(item.page)}
              >
                <ListItemButton>{item.text}</ListItemButton>
              </ListItem>
            ))}
          </List>
          <Divider />
          <List>
            {drawerItems.slice(4).map((item) => (
              <ListItem
                key={item.id}
                onClick={() => handleMenuItemClick(item.page)}
              >
                <ListItemButton>{item.text}</ListItemButton>
              </ListItem>
            ))}
          </List>
        </Box>
      </Drawer>
    </Box>
  );
}
